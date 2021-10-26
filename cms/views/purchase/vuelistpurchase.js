


var app = new Vue({

		el: '#app',	    
	    compras: [],
	    detallecompra:[], 
	    dataTable:"",
	    modaldetail: false,
	    inpsearch: '',
	    finicio:'',
		ffin:'',
	    data: {
	    	compras: [],
	    	detallecompra:[],
	    	modaldetail: false,
	    	subtotal: 0,
			totalitems: 0,
	    	dataTable:"" ,
	    	inpsearch:'',
	    	finicio:'',
			ffin:'',	
	    },
	    data(){
            return {                
                compras: [], 
                detallecompra:[],
                modaldetail: false,
                subtotal: 0,
				totalitems: 0,
                dataTable:"",
                inpsearch:'',
                finicio:'',
				ffin:'',             
            }
            
        },
        
        created (){
            var fi = new Date()
	        var ff = new Date()
	        var fa = new Date(fi.getFullYear() +"-"+ (fi.getMonth() +1) +"-"+fi.getDate())
	        fa.setDate(fi.getDate()-29)
	        ff.setDate(fi.getDate()+1)

        	this.finicio = fa.getFullYear()+"-"+ (((fa.getMonth()+1)<10? '0' + (fa.getMonth()+1) : (fa.getMonth()+1))) +"-"+((fa.getDate()<10)? "0"+fa.getDate():fa.getDate())
	        this.ffin = ff.getFullYear()+"-"+ (((ff.getMonth()+1)<10? '0' + (ff.getMonth()+1) : (ff.getMonth()+1))) +"-"+((ff.getDate()<10)? "0"+ff.getDate():ff.getDate())
	        

        	this.listAllSales(this.inpsearch, this.finicio, this.ffin); 
		},
		mounted() {  
			
                	
        },
		methods:{

			tabla(){
				
				$('#table_listdata').DataTable().destroy();

				this.$nextTick(()=>{

					let table = $('#table_listdata').DataTable({
							"ordering":false,   
					       	"bLengthChange":false,
					        "searching": { "regex": false },
							"lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Todos"] ],
							"pageLength": 20,
							"dom": 'Blfrtip',
							"order": [[2, "desc"],[0, "desc"]],						
					        "destroy":true,
					        "async": false ,
					        select: false,
					        selected:false,
					        "processing": true,
							
					        buttons: [							        	
					           {
					              extend:    "print",footer: 'true',                         
					              text:      '<i class="btn-xs fa fa-print" style="color: #0070FFFF; font-size: 18px;"></i> Imprimir',
					              titleAttr: "Imprimir Productos",
					              title:     "Lista de Compras",
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
					            },
					            {
					              extend:    "excelHtml5",footer: 'true',             
					              text:      '<i class="fa fa-file-excel-o" style="color: #059C00FF; font-size: 16px;"></i> Exportar a excel',
					              titleAttr: "Exportar a excel",
					              title:      "Lista de Compras",
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
					            },
					            {
					              extend:   'pdfHtml5',footer: 'true',             
					              text:     '<i class="fa fa-file-pdf-o" style="color: #FF3F00FF; font-size: 16px;"> </i> Exportar a PDF',
					              titleAttr: "Exportar a PDF",
					              title:    "Lista de Compras",
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
					            },
					            {
					              extend:   'csvHtml5',footer: 'true',             
					              text:     '<i class="fa fa-file-text-o" style="color: #0094FFFF; font-size: 16px;"></i> Exportar a CSV',
					              titleAttr: "Exportar a CSV",
					              title:    "Lista de Compras",
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
					            },
					            {
					              extend:   'copyHtml5',footer: 'true',             
					              text:     '<i class="fa fa-file-text-o" style="color: #FF006EFF; font-size: 16px;"></i> Copiar a Portapapel',
					              titleAttr: "Copiar a Portapapel",
					              title:    "Lista de Compras",
					              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
					            }
					        ],							        
					        "columnDefs": [//ocultar columna
					            {
					                "targets": [0],
					                "visible": false
					            }
					        ],
					        	"language":idioma_espanol,
	       						select: true								 

						});//end table	

				})
			},

			searchpurchase: async function(){
				
				this.listAllSales(this.inpsearch, this.finicio, this.ffin);

			},

			async listAllSales (namecw, finicio, ffin){	
				
				if(namecw.trim() !="" || finicio !="" || ffin!=""){
					let url = 'controllers/purchase/listdetPurchaseController.php';

					let obj = new FormData();
					obj.append("names", namecw)
					obj.append("finicio", finicio)
					obj.append("ffin", ffin)

					await fetch(url, {method: 'POST',body: obj})
					.then(response=>response.json())
					.then(rs=> {	
						let type = rs[0]
						let data = rs[1]

						if(type == '0' || type ==0){

							this.compras =[]

							data.forEach(s=>{

								this.compras.push(s);
							})

							this.tabla();

						}else{
							this.compras =[]
							this.alertSms("info",data);
						}
					})//end 

					

				}else{
					//console.log("ingrese nombre");
					this.articles =[]
				}
				
			},
			
			AbrirModal : function(){				
			},

			rounddecimal: function(amount){
				return (amount).toFixed(2);
			},

			async verdetalle (index){
				//console.log("id es:" +index);

				let url = "controllers/purchase/listdetailSalesController.php"

				let dt = new FormData()
				dt.append('idpay',index)

				fetch(url, {method: 'POST', body: dt})
				.then(son=>son.json())
				.then(data=>{
					if(data[0].id != undefined){
						this.detallecompra = []
						this.subtotal = 0
						this.totalitems = 0
						data.forEach(s=>{
							this.detallecompra.push(s)
							this.totalitems = (1*this.totalitems+1*s.quantity).toFixed(2)
							this.subtotal = (1*this.subtotal+1*(1*s.quantity)*(1*s.price)).toFixed(2)
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