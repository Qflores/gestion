 var app = new Vue({

	    el: '#app',	    
	    productos: [], 
		articles: [],
		medidas:[],
		newunidad: "",
		stadonombre: false,
		codigonuevop: '',
		nombrenuevop: '',
		precionuevop :0,
		cantidadnuevop: 0,
		impuestop: 0,
		auxiliarbyName: "",
		notfount:"",
		customerid:'',
		customername:'',
		customerdoc:'',
		defauldoc: '',	
		descuentopn:0,
		bonificacion:1,
		check:false,
		busname:'',
		bussuc:'',
		busruc:'',
		igv:'',
		buslogo:'',
		moneda:'',
		idoffice:'',
		printsales: '',
		paymethod: '1',
		stock: '',
		voucher:[],
		idvoucher:'',
		listtabs:[],
		selecttab:0,
		titulo:'',
	    data: {
	    	preciomax: null,
	    	name: '',
	    	productos: [], 
	    	articles: [],
			medidas:[],
			newunidad: 'default',
			stadonombre: false,
			nombrenuevop: '',
			precionuevop :0,
			codigonuevop: 0,
			cantidadnuevop: 1,
			impuestop: 0,
			montototal : 0,
			cantidadtotal: 0,
			notfount:"",
			customerid:'',
			customername:'',
			customerdoc:'',
			customer:[],
			defaulname: '',	
			defauldoc: '',
			descuentopn:0,
			bonificacion:1,
			check:false,
			busname:'',
			bussuc:'',
			busruc:'',
			igv:'',
			buslogo:'',
			moneda:'',
			idoffice:'',
			printsales: '',
			paymethod: '1',
			stock: '',
			voucher:[],
			idvoucher:'',
			listtabs:[],
			selecttab:0,
			titulo:'',
	    },
	    data(){
            return {
                articles: [],
                productos: [],
                medidas:[],
                name: '',
                ape :'',
                preciomax: null,
                newunidad: '',
                stadonombre: false,
                nombrenuevop: '',
				precionuevop :null,
				codigonuevop: '',
				cantidadnuevop: 1,
				impuestop: 0,
				montototal : 0,
				cantidadtotal: 0,
				auxiliarbyName: "",
				notfount:"Consumidor Final Seleccionado",
				customerid:'',
				customername:'',
				customerdoc:'',
				customer:[],
				defaulname: '',
				defauldoc: '',	
				descuentopn:0,
				bonificacion:1,
				check:false,
				busname:'',
				bussuc:'',
				busruc:'',
				igv:'',
				buslogo:'',
				moneda:'',
				idoffice:'',
				printsales: '',
				paymethod: '1',
				stock: '',
				voucher:[],
				idvoucher:'1',
				listtabs:[],
				selecttab:0,
				titulo:'ticke',
            }
            
        },
        mounted() {
        	this.nombrenuevop = ""
        	this.idvoucher 	= 1
        	this.voucher 	=[]
        	this.getVocucherAll()
            this.articles	= [] 
            this.getcustomerdefault();
            this.getInfoBusiness();
            this.titulo = 'ticket';
            //this.listtabs=[{'id':1, 'titulo':this.titulo, 'prod':[]}];
            
            fetch('controllers/size/listSizeController.php')
            .then(response=> response.json())
            .then(data=> data.data)
            .then(rs=> rs.map(m=>{
            	this.medidas.push(m)            	
            }))   
        },
        updated: function () {
		 /* this.$nextTick(function () {
		    console.log("hubo cambios en el dom")
		  })*/
		},
		created (){
			let prodDB = JSON.parse(localStorage.getItem('listaVenta'));
		    if(prodDB === null){
		      this.productos = []
		    }else{
		      this.listtabs = prodDB;
		      this.productos = this.listtabs[0].prod;
		      this.sumarprecio()
		    }
		   
		},
        methods:{  

        	deleteall: function(tab){

        		if(tab=='-1'){
        			this.listtabs=[];
        			this.productos =[];
        			localStorage.removeItem('listaVenta')

        		}else{
        			this.listtabs.splice(this.selecttab,1);
        		}
        		
        	},

        	addtab: function(tab){

        		let tabs = 0;

        		this.selecttab =tab;

        		if(tab =='-1'){
        			for(var i =0; i<this.listtabs.length; i++) {
        				tabs = i+1;        			
        			}
        			this.listtabs.push({'id':tabs+1, 'titulo':this.titulo, 'prod':[]});

        		}else{

	        		this.productos = this.listtabs[this.selecttab].prod;
	        		this.sumarprecio();
        		}

        	},

        	roundPriceArt: function(val){

        		return (val).toFixed(2);
        	},      	
        	destruir : function(){
		      this.$destroy();
		    },

		    selectustomer: function(){		    	
		    	if(this.paymethod==2){
		    		this.defaulname=''
					this.customerid=''
					this.defauldoc=''
		    	}else{
		    		this.getcustomerdefault();
		    	}
		    	
		    },

		    getVocucherAll: async function(){
		    	let url = 'controllers/voucher/listVoucherController.php'
		    	await fetch(url)
		    	.then(response=>response.json())
		    	.then(datos=>{
		    		let type = datos[0]
		    		let resp = datos[1]
		    		this.voucher=[]
		    		if (type==0 || type =='0') {
		    			for (var i =0; i<resp.length; i++) { 
		    				this.voucher.push(resp[i]);
		    			}
		    		}else{
		    			console.log(resp);
		    		}
		    	})
		    },

		    getInfoBusiness: async function (){
		    	let url = 'controllers/business/listByIdbusIdPersonController.php';
				await fetch(url, {method: 'POST'})
				.then(response=>response.json())
				.then(data=> {
					let sms = data[0]
					let rs = data[1];

					if(sms==0){						
						this.idoffice	=rs[0].idof
						this.busname	=rs[0].name
						this.bussuc		=rs[0].nombre
						this.busruc 	=rs[0].ruc
						this.igv 		=rs[0].iva
						this.buslogo 	=rs[0].logo
						this.moneda 	= rs[0].simbol
					}else{						
						this.alertSms("info",sms)
					}					
				})
		    },

		    async saveproduct (){
		    	
		    	let formda = new FormData();
		    	let imp =0;

		    	if(this.impuestop){
		    		imp = this.igv
		    	}
		    		formda.append("name",this.nombrenuevop)
		    		formda.append("sku",this.codigonuevop)
		    		formda.append("price",this.precionuevop)
		    		formda.append("canty",this.cantidadnuevop)
		    		formda.append("idbus",this.idoffice)
		    		formda.append("iva",imp)

		    		let head = {method: 'POST', body: formda}
					let config = {headers: {'Content-Type':'multipart/form-data'}}
					let url = "controllers/article/iprodFastController.php";
		    		await fetch(url, head, config)
		    		.then(jso =>jso.json())
		    		.then(res=>{
		    			if(res[0]==0){
		    				this.addProduct()
		    				this.alertSms('success',"producto guardado y agregado")
		    			}else{
		    				this.alertSms('warning',res[1])
		    			}
		    		})

		    },

		    getcustomerdefault: function(){		    	
				let url = 'controllers/customer/getCustomerDefault.php';
				fetch(url, {method: 'POST'})
				.then(response=>response.json())
				.then(rs=> {
						this.defaulname	=rs[0].names
						this.customerid	=rs[0].id
						this.defauldoc	=rs[0].document
				})
				
		    },
		    savecustomer: async function(){
        		if(this.customername.trim() !="" && this.customerdoc.trim() !=""){
        			let url= "controllers/customer/iuCustomerController.php"		
	        		let data = new FormData();
	        			data.append("idc",0)
	        			data.append("namec",this.customername)
	        			data.append("docc",this.customerdoc)
	        		
	        			await fetch(url, {method: 'POST',body: data})
						.then(response=>response.json())
						.then(rs=>{
							if(rs){
								this.buscarcustomer()
							}else{								
								this.notfount = "No se pudo registrar el cliente"
							}							
						})
        		}else{
        			this.notfount="Complete los campos obligatorios luego click aquí"
        		}
        	},

        	async buscarcustomer(){
        		if(this.customername.trim() !=""){
					let url = 'controllers/customer/searchbynamedcoController.php';					
					let obj = new FormData();
						obj.append("rucname", this.customername)

					let head = {method: 'POST', body: obj}
					let config = {headers: {'Content-Type':'multipart/form-data'}}
					
					await fetch(url,head,config)
					.then(response=>response.json())
					.then(rs=> {						
						if(rs[0].id != undefined){
							this.customer =[]
								for (var i=0; i <rs.length ; i++) {
									this.customer.push({"id":rs[i].id,"name":rs[i].names, "ruc":rs[i].document});
								}							
							this.notfount	="";
						}else{											
							this.notfount	="No se encontró un cliente, Click en el boton para registrar"
							this.customer 	=[]				
						}
					})
				}else{	
					this.customername	=""
					this.customerid		=""
					this.customerdoc	=""
					this.customer 		=[]
					this.notfount		="Ingrese numero de documento";
					this.getcustomerdefault();
				}
        	},

        	seleccustomer: function(index){
        		this.customername  	= this.customer[index].name;
        		this.customerdoc 	= this.customer[index].ruc;
        		this.customerid 	= this.customer[index].id;
        		this.customer 		=[]
        	},

        	addunidad: function () {
				if(this.newunidad != ""){
					let obj = {id:'9',name: this.newunidad};
					this.medidas.push(obj);
					this.newunidad ="";
				}else{
					this.alertSms('info','Ingrese unidad de medida');					
				}
    		},
    		validarnombre :function (){
        		let cad = this.nombrenuevop.length;
        		if(cad>5){
        			this.stadonombre = true
        		}else{
        			this.stadonombre = false
        		}
        	},
        	addprodselect : function(index){
        		this.codigonuevop 	= this.articles[index].sku
        		this.nombrenuevop 	= this.articles[index].name
				this.precionuevop 	= this.articles[index].price
				this.cantidadnuevop = 1
				this.impuestop 		= this.articles[index].impuesto
				this.stock 			= this.articles[index].stock
				this.descuentopn	= 0
				this.bonificacion	= 1
				this.addProduct()
				this.articles=[]
        	},
        	
        	eliminarproducto (id){
        		this.productos[id].impuesto = 0;
        		this.productos.splice(id,1);
        		this.sumarprecio();	
        	},
        	cambiarboni(){
        	},

        	sumarprecio(){
				this.montototal=0;
				this.cantidadtotal =0;
				for (var i=0; i<this.productos.length; i++) {
					this.cantidadtotal= (1*this.cantidadtotal+1*this.productos[i].cantidad).toFixed(2)
					this.montototal = (1*this.montototal+((1*this.productos[i].punitario)*(1*this.productos[i].cantidad))-1*this.productos[i].descuento).toFixed(2)
				}
				localStorage.setItem('listaVenta', JSON.stringify(this.listtabs));				
			},

			async searchByname(){				
				if(this.nombrenuevop.trim() !=""){
					let url = 'controllers/article/searchbyidController.php';					
					let obj = new FormData();
						obj.append("sku", this.nombrenuevop)

					let head = {method: 'POST', body: obj}
					let config = {headers: {'Content-Type':'multipart/form-data'}}

					await fetch(url,head,config)
					.then(response=>response.json())
					.then(dt=> {
						let tip = dt[0];
						let rs = dt[1];
						if(tip==0){
							this.articles =[]
								for (var i=0; i <rs.length ; i++) {
									this.articles.push({"sku":rs[i].sku,"name":rs[i].name, "price":rs[i].price, "impuesto":rs[i].iva, "stock":rs[i].stock});
								}
						}else{
							this.articles =[]
						}
					})
				}else{
					this.articles =[]
				}
			},
			searchBySku: function(){				
				if(this.codigonuevop != ""){
					this.apigetdata('controllers/article/searchbyidController.php')
				}
			},
			async apigetdata(url){								
				let obj = new FormData();
					obj.append("sku", this.codigonuevop)
				let dt = {method: 'POST',body: obj}

				await fetch(url, dt)
				.then(response=>response.json())
				.then(data=>data)
				.then(rs=>{
					let res = rs[0]
					let data = rs[1]
					if(res==0){
						this.codigonuevop 	=data[0].sku
						this.nombrenuevop	=data[0].name
						this.precionuevop	=data[0].price
						this.cantidadnuevop	=1
						this.impuestop		=data[0].iva
						this.stock			=data[0].stock
						this.addProduct();
					}else{
						this.alertSms("info","No hay productos con ese código")
					}					
				})
        	},

        	addProduct :function(){
        		let existe = false;
        		
        		for (var i =0; i<this.listtabs[this.selecttab].prod.length; i++) {
        			if(this.listtabs[this.selecttab].prod[i].sku == this.codigonuevop){
        				existe = true
        				this.listtabs[this.selecttab].prod[i].cantidad= (1*this.listtabs[this.selecttab].prod[i].cantidad)+(1*this.cantidadnuevop)
        				this.sumarprecio();
						this.nombrenuevop	=""
						this.precionuevop	=""
						this.codigonuevop	=""
						this.cantidadnuevop	=""
						this.descuentopn 	=0
						this.bonificacion 	=1
						this.stock 			=""
	        		}
        		}
        		
        		if(!existe){
        			let skun 	= this.codigonuevop;
	        		let namen 	= this.nombrenuevop;
					let pricen 	= this.precionuevop;
					let cantyn 	= this.cantidadnuevop;
					let ivan 	= this.impuestop;
					let descn 	= this.descuentopn;
					let bonin 	= this.bonificacion;
					let stoc 	= this.stock;

					let punit 	= (1*pricen/1*cantyn).toFixed(2);
					let pricet 	= (1*bonin*((1*punit*cantyn)-1*descn)).toFixed(2);	

					if(cantyn != "" && namen != "" &&  punit != null && cantyn != null){

						this.listtabs[this.selecttab].prod.push({'sku':skun, 'nombre':namen,'cantidad':cantyn, 'punitario':punit, 'precio':pricet, 'descuento':descn, 'bonificacion':bonin,'impuesto':ivan,'stock':stoc});
						
						this.sumarprecio();
						this.nombrenuevop	=""
						this.precionuevop	=""
						this.codigonuevop	=""
						this.cantidadnuevop	=""
						this.bonificacion	=1
						this.descuentopn	=0
						this.stock			=""
					} else{						
						this.alertSms("info","Complete los campos del producto")
					}
        		}
        	},

        	async savepurshase(){
        	if(this.customerid != '0' || this.customerid!=''){
        		if(this.productos != ""){
        			var fordata = new FormData();
		        	fordata.append("idvoucher",this.idvoucher) //2=factura, 4=boleta de venta
		        	fordata.append("descuento",0) // 2=compras, 1=ventas
		        	fordata.append("state",this.paymethod) // 2=compras, 1=ventas
		        	fordata.append("idcustomer",this.customerid) // Empresa Flores Sac
		        	fordata.append("nfact","f00-001") // numero de facura		        	

		        	fordata.append("producto",JSON.stringify(this.productos))
		        	const config ={headers: {'Content-Type': 'multipart/form-data'}}
		        	await axios.post('controllers/sales/iuSalesController.php',fordata, config)
		      		.then(response=>response.data)
		      		.then(res=>{
		      			if (res[0]=='1') { 
		      				// borramos el arreglo producto detalle
		      				this.listtabs.splice(this.selecttab,1);
		      				
		      				//localStorage.removeItem('listaVenta');

		      				this.productos 	=[]; 
		      				this.paymethod	=1;
		      				this.sumarprecio();
		      				this.alertSms("success",'Venta exitosa')
		      				this.customername	=""
		      				this.customerid		="0"
		      				this.customerdoc	=""
		      				this.getcustomerdefault();
		      				if(this.printsales){
		      					let idfact = res[1];
		      					window.open("printtiket/tickedmary.php?idventa="+idfact+"#zoom=100%","Tiket","scrollbars=NO");
		      				}
		      			}
		      			if (res[0]=='2') {				
		      				this.alertSms("error",res[1])
		      			}

		      			if(res[0]=='0'){
		      				this.alertSms("warning",res[1])
		      			}
		      			if(res[0]=='3'){
		      				Swal.fire({ position: 'top-center',
				                icon: 'info',
				                title: 'Su sesión a expirado, Inicie sessión',
				                showConfirmButton: false,
				                timer: 2000,
				                timerProgressBar: true,
				                onBeforeOpen: ()=>{
				                  Swal.showLoading()
				                }
				            }).then((result) =>{
				              if(result.dismiss === Swal.DismissReason.timer){
				                location.reload();
				                location.href="../logout/";
				              }
				            })
		      			}
		      		});
        		}else{
        			this.alertSms("warning","Venta vacía, Agregue productos")
        		}
        	}else{
        		this.alertSms("warning","Seleccione un cliente")
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


    }, //end methods
    computed: {
        	
    },// end computed
});