
var app = new Vue({
	el: '#app',	 
	idb:0,
	ido:0,
	idm:0,
	business: [],
	businesslista: [],
	office:[],
	officelista:[],
	filelogo:'',
	money:[],
	zonaname:'',
	zonas:[],
	selectlogo: '',	
	name:'',
	ruc:'',
	stado:'',
	idof:'',
	nombre:'',
	address:'',
	phone:'',
	timezone:'',
	printer:'',
	printerhost:'',
	email: '',
	keypos:'',
	iva:'',
	oldimg:'',
	editactive: false,
	busselected: 0,

	data:{
		idb:0,
		ido:0,
		idm:0,
		business: [],
		businesslista: [],
		office:[],
		officelista:[],
		filelogo:"",
		money:[],
		zonaname:'',
		zonas:[],
		selectlogo: '',
		email: '',
		name:'',
		ruc:'',
		logo:'',
		stado:'',
		idof:'',
		nombre:'',
		address:'',
		phone:'',
		timezone:'',
		printer:'',
		printerhost:'',
		keypos:'',
		iva:'',
		oldimg:'',
		editactive: false,
		busselected: 0,
	},
	data(){
		return{
			idb:0,
			ido:0,
			idm:0,
			business: [],
			businesslista: [],
			office:[],
			officelista:[],
			filelogo:'',
			money:[],
			zonaname:'',
			zonas:[],
			selectlogo: 'btn-outline-warning',
			email: '',
			
			name:'',
			ruc:'',
			stado:'',
			idof:'',
			nombre:'',
			address:'',
			phone:'',
			timezone:'',
			printer:'',
			printerhost:'',
			keypos:'',
			iva:'',
			selected:'',
			oldimg:'',
			editactive: false,
			busselected: 0,
		}
	},
	mounted() {
		//this.money = []
		//this.businesslista=[]
		this.getBusiness()
		this.getMoney()
		this.getZona();
	},
	updated: function () {	
	},
	created (){

	},
	methods:{
        async getMoney(){
        	let url = "controllers/money/listMoneyController.php";
			let datos = {method: 'POST'}
			await fetch(url, datos)			
			.then(jso=>jso.json())
			.then(res=>{				
				let mo = res['data'];
				if(mo[0].id != undefined){ 
					this.money = "";					
					this.money= mo;					
				}
			})
        },
        setfile : function(){
        	this.filelogo = this.$refs.file.files[0];
        	if(this.filelogo==undefined){
        		this.selectlogo = 'btn-outline-danger'
        	}else{
        		this.selectlogo = 'btn-outline-success'
        	}
        	
        },
        async getZona(){
        	let url = "controllers/Zona/listZonaController.php";
			let datos = {method: 'POST'}
			await fetch(url, datos)			
			.then(jso=>jso.json())
			.then(res=>{
				this.zonas = res;				
			})
        },
        async getBusiness(){
        	let url = "controllers/business/listBussinesByidUser.php";
			let datos = {method: 'POST'}

			await fetch(url, datos)
			.then(jso=>jso.json())
			.then(res=>{				
				this.businesslista =[]
				let list = res[1];
				if(list[0].idb != undefined){
					this.busselected = res[2];
					for (var i=0; i<list.length; i++) {
						this.businesslista.push(list[i])
					}
				}else{
					//console.log("no hay lista pra moestrar")
				}
			})
			.catch(err=>{
				//console.log("error lista Empresas: "+err);
				
			})
        },
        editBusiness: function(index){

        	this.idb = this.businesslista[index].idb
			this.name = this.businesslista[index].nameb
			this.ruc = this.businesslista[index].rucb
			//this.filelogo = this.businesslista[index].lgo
			this.ido = this.businesslista[index].ido
			this.nombre = this.businesslista[index].nombre
			this.address = this.businesslista[index].address
			this.phone = this.businesslista[index].phone
			this.timezone = this.businesslista[index].timezone
			this.printer = this.businesslista[index].printer
			this.printerhost = this.businesslista[index].printerhost
			this.iva = this.businesslista[index].iva*100
			this.idm = this.businesslista[index].idmoneda
			this.oldimg =this.businesslista[index].logob
			this.email =this.businesslista[index].email

			if(this.editactive) {
				this.editactive=false
			}else{
				this.editactive=true
			}

        },
        cleanform: function(){
        	this.idb = ""
			this.name = ""
			this.ruc = ""
			this.filelogo = ""
			this.ido = ""
			this.nombre = ""
			this.address = ""
			this.phone = ""
			this.timezone = ""
			this.printer = ""
			this.printerhost = ""
			this.iva = ""
			this.idm = ""
			this.oldimg = ""
			this.email=""
        },
        newOffice: function(index){
        	this.cleanform();
        	this.editactive=false
        	this.idb = this.businesslista[index].idb        	
			this.ido=0;
			$('#modal_editupdate').modal('show');
			
        },
        getOffice: function(index){
        	
        },
        newBusiness: function(){        	
        	var element = this.$refs['formbusiness'];
      		var top = element.offsetTop;
      		window.scrollTo(0, top);
      		this.cleanform();
        	this.editactive=true
        	this.idb = 0
        	this.ido = 0
        },
        async saveOffice(){
        	let formda = new FormData();
			formda.append('idb', this.idb)
			formda.append('idof', this.ido)
			formda.append('nombre', this.nombre)
			formda.append('address', this.address)
			formda.append('phone', this.phone)
			formda.append('timezone', this.timezone)
			formda.append('printer', this.printer)
			formda.append('printerhost', this.printerhost)
			formda.append('keypos', '')
			formda.append('iva', this.iva)
			formda.append('idmoneda', this.idm)
			formda.append('email', this.email)

			let url = "controllers/office/iaOfficeController.php";
			const config ={headers: {'Content-Type': 'multipart/form-data'}}
			let datos = {method: 'POST', body:formda}	

			await fetch(url, datos, config)
			.then(jso=>jso)
			.then(res=>{
				if(res.status==200){
					$('#modal_editupdate').modal('hide');
					this.getBusiness()
					this.cleanform()
					this.editactive=false
					this.swelAlert('success','Datos de empresa Actualizada. Code: '+res.status)
				}
				if(res.status==304){
					//res.statusText
					this.swelAlert('error',"Error Code: "+res.status+ " "+res.statusText)
				}
				//console.log(res);
			})
			.catch(err=>{
				//console.log("error: "+ err);
			})

        },
        async saveBusiness (){

        	let formda = new FormData();

			formda.append('idb', this.idb)
			formda.append('name', this.name)
			formda.append('ruc', this.ruc)
			formda.append('filelogo', this.filelogo)
			formda.append('stado', '1')
			formda.append('idof', this.ido)
			formda.append('nombre', this.nombre)
			formda.append('address', this.address)
			formda.append('phone', this.phone)
			formda.append('timezone', this.timezone)
			formda.append('printer', this.printer)
			formda.append('printerhost', this.printerhost)
			formda.append('keypos', '')
			formda.append('iva', this.iva)
			formda.append('idmoneda', this.idm)
			formda.append('oldimg', this.oldimg)
			formda.append('email', this.email)

			let url = "controllers/business/iabusinessController.php";
			const config ={headers: {'Content-Type': 'multipart/form-data'}}
			let datos = {method: 'POST', body:formda}	

			await fetch(url, datos, config)			
			//.then(jso=>jso.status)
			.then(jso=>jso)
			.then(res=>{
				if(res.status==200){
					this.getBusiness()
					this.cleanform()
					this.editactive=false
					this.swelAlert('success','Datos de empresa Actualizada. Code: '+res.status)
				}
				if(res.status==304){
					//res.statusText
					this.swelAlert('error',"Error Code: "+res.status+ " "+res.statusText)
				}
			})
			.catch(err=>{
				//console.log("error: "+ err);
			})

        },
        swelAlert: function(tipe, sms){
        	Swal.fire({ position: 'top-center',
		    icon: tipe,
		    title: sms,
		    showConfirmButton: false,              
		    timer: 1100,
		    timerProgressBar: true,
		    onBeforeOpen: ()=>{
		      Swal.showLoading()
		    }
		  });
        }


    }//end method
	

})