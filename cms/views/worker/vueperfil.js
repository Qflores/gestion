
var app = new Vue({
	el:'#app',
	idper:'',
	namep:'',
	emailp:'',
	phonep:'',
	docp:'',
	addressp:'',
	photop:'',
	passuserold:'',
	passuser1:'',
	passuser2:'',
	user:[],
	offices:[],
	picture:'',
	selectfoto:'',
	data:{
		idper:'',
		namep:'',
		emailp:'',
		phonep:'',
		docp:'',
		addressp:'',
		photop:'',
		passuserold:'',
		passuser1:'',
		passuser2:'',
		user:[],
		offices:[],
		picture:'',
		selectfoto:'',
	},
	data(){
    	return {
    		idper:'',
    		namep:'',
			emailp:'',
			phonep:'',
			docp:'',
			addressp:'',
			photop:'',
			passuserold:'',
			passuser1:'',
			passuser2:'',
			user:[],
			offices:[],
			picture:'',
			selectfoto:'btn-outline-warning',
    	}
    },

	mounted(){
		this.user=[]
		this.getPerfil();

	},
	created(){

	},
	methods:{

		getPerfil : async function(){	
			let  url = "controllers/worker/getByIdPersonController.php"
			let  config ={headers: {'Content-Type': 'multipart/form-data'}}
			let  head = {method: 'POST'}
			
			await fetch(url,head,config)
			.then(parse=>parse.json())
			.then(data=>{
				app.user.push(data);
				this.idper =data[0].id
				this.namep = data[0].names
				this.emailp = data[0].email
				this.phonep = data[0].phone
				this.docp = data[0].document
				this.addressp = data[0].address
				this.photop = data[0].foto
			})

		},
		setPicture: function(){
			this.picture = this.$refs.file.files[0];
        	if(this.picture==undefined){
        		this.selectfoto = 'btn-outline-danger'
        	}else{
        		this.selectfoto = 'btn-outline-success'
        	}

		},
		saveperfil: function(){
			let url = "controllers/person/iuPersonController.php"
			let config ={headers: {'Content-Type': 'multipart/form-data'}}

			let  fordata = new FormData();
	        	fordata.append("idper",this.idper)
	        	fordata.append("namep",this.namep)
	        	fordata.append("emailp",this.emailp)
	        	fordata.append("phonep",this.phonep)
	        	fordata.append("docp",this.docp)
	        	fordata.append("addressp",this.addressp)
	        	fordata.append("photo",this.picture)
	        	fordata.append("photoold",this.photop)
	        
	        let head = {method: 'POST', body: fordata}

	        fetch(url,head,config)
			.then(parse=>parse.json())
			.then(data=>{				
				if(data==1 || data == "1"){
					this.getPerfil()
					this.alertSms("success","Datos Actualizados");
				}else{
					this.alertSms("error", data);
				}
				
			})

		},
		changePassword: function(){

			if (this.passuser1 === this.passuser2) {
				let url = "controllers/person/upasswordController.php"
				let config ={headers: {'Content-Type': 'multipart/form-data'}}

				let datas = new FormData();
		        	datas.append("idper",this.idper)
		        	datas.append("passuserold",this.passuserold)
		        	datas.append("passuser1",this.passuser1)
		        	

		        let head = {method: 'POST', body: datas}

		        fetch(url, head, config)
				.then(parse=>parse.json())
				.then(data=>{
					if(data ==1 || data == '1'){
						this.alertSms("success","Contraseña actualizado");						
						this.passuserold = ""
						this.passuser1 = ""
						this.passuser2 = ""
					}else{
						this.alertSms("error", "la contraseña no se pudo actualizar");
					}					
				})

				
			}else{
				this.alertSms("error", "La contraseña nueva no son iguales");
			}

			

		},
		alertSms:function(typoaler,sms){
		    Swal.fire({ position: 'top-center',
		    icon: typoaler,
		    title: sms,
		    showConfirmButton: false,              
		    timer: 1000,
		    timerProgressBar: true,
		    onBeforeOpen: ()=>{
		      Swal.showLoading()
		    }
		  });
		}


	},//end method
	computed: {
        	
    },// end computed

});