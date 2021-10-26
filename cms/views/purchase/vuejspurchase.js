var app = new Vue({

	    el: '#app',
	    apel: '',	
	    productos: [], 
		articles: [],
		medidas:[],
		newunidad: "",
		stadonombre: false,
		codigonuevop: '',
		nombrenuevop: '',
		precionuevop :0,
		cantidadnuevop: 0,
		impuestop: false,
		auxiliarbyName: "",
		businessname:"",
		businessdoc:"",
		businessid:"",
		notfount:'',
		idvoucher:'',
		voucher:[],
		stock:'',
	    data: {
	    	preciomax: 5,
	    	name: '',
	    	productos: [], 
	    	articles: [],
			medidas:[],
			newunidad: 'default',
			stadonombre: false,
			nombrenuevop: '',
			precionuevop :0,
			codigonuevop: 0,
			cantidadnuevop: 0,
			impuestop: false,
			montototal : 0,
			cantidadtotal: 0,
			businessname:"",
			businessdoc:"",
			businessid:"0",
			supplier:[],
			notfount:'',
			idvoucher:'',
			voucher:[],
			stock:'',
	    },
	    data(){
            return {
                articles: [],
                productos: [],
                medidas:[],
                name: '',
                ape :'',
                preciomax: 5,
                newunidad: '',
                stadonombre: false,
                nombrenuevop: '',
				precionuevop : null,
				codigonuevop: '',
				cantidadnuevop: null,
				impuestop: false,
				montototal : 0,
				cantidadtotal: 0,
				auxiliarbyName: "",
				businessname:"",
				businessdoc:"",
				businessid:"0",
				supplier:[],
				notfount:'',
				idvoucher:'1',
				voucher:[],
				stock:'',
            }
            
        },
        mounted() {

        	this.businessid	='0'
        	this.notfount	="Seleccione un proveedor para realizar la compra"
        	this.nombrenuevop = ""
            this.articles	= []
            this.voucher	=[]
            this.getVocucherAll()

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
			let prodDB = JSON.parse(localStorage.getItem('lscompra'));   
		    //console.log(prodDB);
		    if(prodDB === null){
		      this.productos = []
		      //console.log("Datos vacios");
		    }else{
		      this.productos = prodDB;
		      this.sumarprecio()// llamamos el metodo para sumar precios
		    }
		},
        methods:{
        	addunidad: function () {
				if(this.newunidad != ""){
					let obj = {id:'9',name: this.newunidad};
					this.medidas.push(obj);
					this.newunidad ="";
				}else{
					//console.log("Ingrese unidad de medida");
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
    		validarnombre :function (){
        		let cad = this.nombrenuevop.length;
        		if(cad>5){
        			this.stadonombre = true
        		}else{
        			this.stadonombre = false
        		}
        	},
        	saveproveedor: function(){
        		if(this.businessname.trim() !="" && this.businessdoc.trim() !=""){
        			let url= "controllers/supplier/iuSupplierController.php"        		
	        		let data = new FormData();
	        			data.append("id",0)
	        			data.append("namep",this.businessname)
	        			data.append("nump",this.businessdoc)
	        		
	        			fetch(url, {method: 'POST',body: data})
						.then(response=>response.json())
						.then(rs=>{
							if(rs){
								this.buscarproveedor()
							}else{								
								this.notfount = "No se pudo registrar el proveedor"
							}							
						})

        		}else{
        			this.notfount="Complete los campos obligatorios luego click aquí"
        		}

        		

        	},
        	async buscarproveedor(){

        		if(this.businessname.trim() !=""){
					let url = 'controllers/supplier/getbyrucnameController.php';
					
					let obj = new FormData();
					obj.append("rucname", this.businessname)

					await fetch(url, {
							method: 'POST',
							body: obj
						})
					.then(response=>response.json())
					.then(rs=> {						
						if(rs[0].id != undefined){
							this.supplier =[]
								for (var i=0; i <rs.length ; i++) {
									this.supplier.push({"id":rs[i].id,"name":rs[i].name, "ruc":rs[i].document});
								}
							//console.log(rs);
							this.notfount="";
						}else{
							
							this.notfount="No se encontró proveedores Click en el boton para registrar"
							this.supplier =[]
							//console.log(rs);
						}
					})

				}else{					
					this.supplier =[]
					this.notfount="Ingrese razon social o ruc";
				}

        	},
        	selecsupplier: function(index){
        		this.businessname 	=this.supplier[index].name;
        		this.businessdoc 	=this.supplier[index].ruc;
        		this.businessid 	=this.supplier[index].id;
        		this.supplier 		=[]
        	},
        	addprodselect : function(index){
        		this.codigonuevop 	= this.articles[index].sku;
        		this.nombrenuevop 	= this.articles[index].name;
        		this.stock		 	= this.articles[index].stock;
				this.impuestop		= this.articles[index].impuesto;
				this.precionuevop 	= null
				this.cantidadnuevop = null				
				this.articles		=[]
        	},
        	addProduct :function(){

    			let skun 	= this.codigonuevop;
        		let namen 	= this.nombrenuevop;
				let pricen 	= this.precionuevop;
				let cantyn 	= this.cantidadnuevop;
				let ivan 	= this.impuestop;
				let stoc 	= this.stock;
				let descn 	= 0//this.descuentopn;
				let bonificacion 	= false

				let punit 	= (1*pricen/(1*cantyn)).toFixed(4);				
				let pricet 	= ((1*punit*cantyn)-1*descn).toFixed(4);		

				if(skun !="" && namen !="" &&  pricen!= null && cantyn !=null){
					this.productos.push({'sku':skun, 'nombre':namen, 'cantidad':cantyn, 'punitario':punit, 'precio':pricet,'bonificacion':bonificacion,'impuesto':ivan, 'stock':stoc});
					this.sumarprecio();
					this.codigonuevop	=""
					this.nombrenuevop	=""
					this.precionuevop	=""
					this.cantidadnuevop	=""
					this.impuestop		=""
					this.stock			=""
				localStorage.setItem('lscompra', JSON.stringify(this.productos))
				} else{					
					this.alertSms("info","Complete los campos")
				}

        	},
        	eliminarproducto (id){
        		this.productos[id].impuesto = false;
        		this.productos.splice(id, 1);
        		this.sumarprecio();

        	},

        	sumarprecio(){
				this.montototal=0;
				this.cantidadtotal =0;
				for(pro of this.productos){
					this.montototal = (1*this.montototal+(1*pro.cantidad*1*pro.punitario)).toFixed(2);
					this.cantidadtotal = (1*this.cantidadtotal+1*pro.cantidad).toFixed(2);
				}				
				localStorage.setItem('lscompra', JSON.stringify(this.productos));// guardamos las tareas en localStorage
			},

			async searchByname (){				
				if(this.nombrenuevop.trim() !=""){
					let url = 'controllers/article/searchbyidController.php';
					let obj = new FormData();
					obj.append("sku", this.nombrenuevop)
					await fetch(url, {
							method: 'POST',
							body: obj
						})
					.then(response=>response.json())
					.then(data=> {
						let tip = data[0];
						let rs = data[1];

						if(tip == 0){
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

			buscarproducto: function(){
				if(this.codigonuevop != ""){
					this.apigetdata('controllers/article/searchbyidController.php')
				}
			},
			async apigetdata(url){
				
				let obj = new FormData();
					obj.append("sku", this.codigonuevop)
				let head = {method:'POST',	body: obj}

				await fetch(url,head)
				.then(response=>response.json())
				.then(res=>{
					let type = res[0];
					let data = res[1]
					if(type==0 || type =='0'){
						this.codigonuevop 	=data[0].sku
						this.nombrenuevop	=data[0].name
						this.impuestop 		=data[0].iva
						this.stock 			=data[0].stock
					}else{
						this.alertSms("error",data)
					}				
				})			
        },
        async savepurshase(){

        	if(this.businessid.trim() !='0' && this.businessdoc.trim() !="" && this.productos !=""){
        		var fordata = new FormData();
		        	fordata.append("idvoucher",this.idvoucher) //2=factura, 4=boleta de venta
		        	fordata.append("idopera","2") // 2=compras, 1=ventas
		        	fordata.append("idsupplier",this.businessid)
		        	fordata.append("nfact","f00-001")
		        	fordata.append("producto",JSON.stringify(this.productos))
	        	const config ={headers: {'Content-Type': 'multipart/form-data'}}
	        	await await axios.post('controllers/purchase/iuPurchaseController.php',fordata, config)
	      		.then(response=>response.data)
	      		.then(res=>{      			
	      			if (res[0]=='1') {      				
	      				localStorage.removeItem('lscompra');
	      				this.productos 	= [];      				
	      				this.sumarprecio();
	      				this.alertSms("success",res[1])
	      				this.businessid	="";
	      				this.businessdoc="";
	      				this.businessname="";
	      				this.notfount	="Seleccione un proveedor"
	      			}
	      			if (res[0]=='2') {      				
	      				this.alertSms("error",res[1])
	      			}

	      			if(res[0]=='0'){
	      				this.alertSms("warning",res[1])
	      			}
	      		})
        	}else{
        		this.alertSms("warning","Seleccione un proveedor")
        	}
        	
        },
        alertSms:function(typoaler,sms){
		    Swal.fire({ position: 'top-center',
		    icon: typoaler,
		    title: sms,
		    showConfirmButton: false,              
		    timer: 1100,
		    timerProgressBar: true,
		    onBeforeOpen: ()=>{
		      Swal.showLoading()
		    }
		  });
		},
		twodecimal(valor){
    		return valor.toFixed(4);
    	},
    	calbonificacion(index){
    		
    	}

    }, //end methods
    computed: {    	
        	
    },// end computed
});