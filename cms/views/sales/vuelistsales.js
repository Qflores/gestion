


var app = new Vue({

		el: '#app',	    
	    sales: [],
	    dataTable:null,
	    modaldetail: false,
	    fstart:'',
	    fend:'',
	    searchname:'',
	    table:'',
	    hstate:'',
	    data: {
	    	sales: [],
	    	salesdetail:[],
	    	modaldetail: false,
	    	subtotal: 0,
			totalitems: 0,
	    	dataTable:null,
	    	fstart:'',
	    	fend:'', 
	    	searchname:'', 	
	    	table:'',
	    	hstate:'',
	    },
	    data(){
            return {                
                sales: [], 
                salesdetail:[],
                modaldetail: false,
                subtotal: 0,
				totalitems: 0,
                dataTable:null,
                fstart:'',
	    		fend:'',
	    		searchname:'', 
	    		table:'',
	    		hstate:'',
            }
            
        },
        
        created (){           
		    this.hstate = 1
	        var fi = new Date()
	        var ff = new Date()
	        var fa = new Date(fi.getFullYear() +"-"+ (fi.getMonth() +1) +"-"+fi.getDate())
	        fa.setDate(fi.getDate()-29)
	        ff.setDate(fi.getDate()+1)

	        this.fstart = fa.getFullYear()+"-"+ (((fa.getMonth()+1)<10? '0' + (fa.getMonth()+1) : (fa.getMonth()+1))) +"-"+((fa.getDate()<10)? "0"+fa.getDate():fa.getDate())
	        this.fend = ff.getFullYear()+"-"+ (((ff.getMonth()+1)<10? '0' + (ff.getMonth()+1) : (ff.getMonth()+1))) +"-"+((ff.getDate()<10)? "0"+ff.getDate():ff.getDate())
	        
	        this.listAllSales(this.searchname, this.fstart, this.fend,this.hstate);  

		},
		mounted() {        	

        },
		methods:{

			tabla(){
				
				$('#table_listdata').DataTable().destroy();

				this.$nextTick(()=>{					
					let table= $('#table_listdata').DataTable({
						"lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "todo"] ],
						"pageLength": 20,
						"dom": 'Blfrtip',
						"procesing":true,
						//"serverSide":true,
						"destroy":true,
						retrieve: true,
    					paging: true,
						"order": [[1,"desc"]],

				        buttons: {
				        	dom:{
				        		button:{
				        			className: 'btn'
				        		}
				        	},
				            buttons:[
				            	{
					              extend:    "print",footer: 'true',                         
					              text:      '<i class="fa fa-print" > </i> Imprimir',
					              titleAttr: 'Imprimir Productos',
					              title:     "Lista de Ventas",
					              className: 'btn btn-outline-primary',
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6,7] }
					            },
					            {
					              extend:    "excelHtml5",footer: 'true',             
					              text:      '<i class="fa fa-file-excel-o"></i> Exportar a excel',
					              titleAttr: "Exportar a excel",
					              className: 'btn btn-outline-success',
					              title:      "Lista de Ventas",
					              excelStyles :{					              	
					              	cells: '2',
					              	style:{
					              		font: {
					              			name: 'Arial',
					              			size: '12',
					              			b: true,
					              			color:'ffffff'
					              		},
					              		fill:{
					              			pattern:{
					              				color:'ff7e12'
					              			}
					              		}					              	
					              	},
					              	cells:'sA',
					              	condition:{
					              		type:'cellIs',
					              		operator:'between',
					              		formula: [5,10]
					              	},
					              	style:{
					              		font:{
					              			b:true
					              		},
					              		fill:{
					              			pattern:{
					              				bgColor: '299a0b'
					              			}
					              		}
					              	}
					              },
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6,7] }
					            },
					            {
					              extend:   'pdfHtml5',footer: 'true',             
					              text:     '<i class="fa fa-file-pdf-o"> </i> Exportar a PDF',
					              titleAttr: "Exportar a PDF",
					              title:    "Lista de Ventas",
					              className: 'btn btn-outline-warning',
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6,7] }
					            },
					            {
					              extend:   'csvHtml5',footer: 'true',             
					              text:     '<i class="fa fa-file-text-o"></i> Exportar a CSV',
					              titleAttr: "Exportar a CSV",
					              title:    "Lista de Ventas",
					              className: 'btn btn-outline-info',
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6,7] }
					            },
					            {
					              extend:   'copyHtml5',footer: 'true',             
					              text:     '<i class="fa fa-file-text-o"></i> Copiar a Portapapel',
					              titleAttr: "Copiar a Portapapel",
					              title:    "Lista de Ventas",
					              className: 'btn btn-outline-danger',
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6,7] }
					            }

							]				            
				        },							        
				        "columnDefs": [//ocultar columna
				            {
				                "targets": [0],
				                "visible": false
				            }
				        ],								 
					        "language":idioma_espanol,
	       					select: true

					});//end table
				});
			},

			searchbyFilter(){
				
				this.listAllSales(this.searchname, this.fstart, this.fend, this.hstate);
				
			},			

			async listAllSales (namecw, finicio, ffin, state){	

				if(namecw.trim() !="" || finicio !="" || ffin!=""){

					let url = 'controllers/sales/listSalesControler.php';

					let obj = new FormData();
					obj.append("names", namecw)
					obj.append("finicio", finicio)
					obj.append("ffin", ffin)
					obj.append("state", state)


					await fetch(url, {method: 'POST',body: obj})
					.then(response=>response.json())
					.then(rs=> {										
						if(rs[0]==='0'){							
							this.sales=[];
							this.articles =[]
							let data = 	rs[1]						
							data.forEach(s=>{
								this.sales.push(s);
							})
							this.tabla();											
						}else{
							this.sales=[]
							this.tabla();
						}						
					})//end fetch
				}//end if
			},

			payacount : function(idhead){
				Swal.fire({
					  title: 'Desea Pagar la cuenta? Ingrese Su contraseña',
					  input: 'password',
					  inputAttributes: {
					    autocapitalize: 'off',
					    autocomplete:'off',
					    placeholder: 'Ingrese su contraseña',
					    required: true,
					    min: 5,
    					max: 20,
					  },
					  showCancelButton: true,
					  confirmButtonText: 'Quiero Abonar',
					  showLoaderOnConfirm: true,
					  preConfirm: (login) => {
					  	let url = "controllers/sales/upaymethodOnheaderController.php";
					  	let formdata = new FormData();
							formdata.append('pass',login);
							formdata.append('idhead',idhead);
							let head = {method: 'POST', body:formdata};
							let config = {headers: {'Content-Type':'multipart/form-data'}}
					    return fetch(url, head, config)
					      .then(response => response.json())
					      .then(res=>{
					        if (res!=1 || res!='1') {
					          throw new Error(res)
					        }
					        return res
					        //console.log("despues del res")
					        
					      }).catch(error => {
					        Swal.showValidationMessage(
					          `${error}`
					        )
					      })
					  },
					  allowOutsideClick: () => !Swal.isLoading()
					}).then((result) => {						
					  if (result.value) {
					  	this.alertSms('success','La cuenta fue Abonado con éxito')					  	
					  	let mitable = $('#table_listdata').DataTable()
					  		//mitable.ajax.reload()
					  		//mitable.ajax.reload(this.salesdetail,true)
					  }
					})
			},

			rounddecimal: function(amount){
				return (amount).toFixed(2);
			},

			printsales: function(id){
				window.open("printtiket/tickedmary.php?idventa="+id+"#zoom=100%","Tiket","scrollbars=NO");
			},

			vervetalle: function(index){
				//console.log("id es:" +index);

				let url = "controllers/sales/listsalesdetailController.php"

				let dt = new FormData()
				dt.append('idsale',index)

				fetch(url, {method: 'POST', body: dt})
				.then(son=>son.json())
				.then(data=>{
					if(data[0].id != undefined){
						this.salesdetail = []
						this.subtotal = 0
						this.totalitems = 0
						data.forEach(s=>{
							this.salesdetail.push(s)
							this.totalitems = (1*this.totalitems+1*s.canty).toFixed(2)
							this.subtotal = (1*this.subtotal+1*(1*s.canty)*(1*s.price)).toFixed(2)
						})						
						$("#modaleditupdate").modal("show");
					}
				})

				
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
				}//end alert

		}, //end methods
	    computed: {
	        	
	    },// end computed


})// end vue