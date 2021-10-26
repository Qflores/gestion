
 var app = new Vue({

	    el: '#app',
	    
	    productos: [], 
		articleinfo: [],		
		filekardex: "",
        finicio:'',
        skuprod:'',
        editactive:false,
        editactive2: false,
        nombrep:'',
        unidadp:'',
        officep:'',
        table:'',

	    data: {	    	
	    	productos: [], 
	    	articleinfo: [],
	    	filekardex: "",
            finicio:'',
            skuprod:'',
            editactive:false,
            editactive2: false,
            nombrep:'',
            unidadp:'',
            officep:'',
            table:'',

			
	    },
	    data(){
            return {
                articleinfo: [],
                productos: [],
                filekardex: "",
                finicio:'',
                skuprod:'',
                editactive:false,
                editactive2: false,
                nombrep:'',
                unidadp:'',
                officep:'',
                table:'',
            }
            
        },
        mounted() {

            this.skuprod = '092'

        	var fa = new Date()
            this.finicio = fa.getFullYear()+"-"+ (((fa.getMonth()+1)<10? '0' + (fa.getMonth()+1) : (fa.getMonth()+1))) +"-"+((fa.getDate()<10)? "0"+fa.getDate():fa.getDate())
	        
            var mesactual = fa.getMonth()+1

        	this.getkardexBySku(mesactual, this.skuprod);
        	  
        },
        updated: function () {
		
		},
        methods:{

            tabla(){
                
            $('#tablelistdata').DataTable().destroy();
                //$('#tablelistdata').DataTable().clear();
            this.$nextTick(()=>{ 

                let table= $('#tablelistdata').DataTable({
                        "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "todo"] ],
                        "pageLength": 40,
                        "dom": 'Blfrtip',
                        "procesing":true,
                        "destroy":true,
                        retrieve: true,
                        paging: true,
                        "order": [[1,"asc"]],
                       /* "columns":[
                            {"data":"fecha"},
                            {"data":"num_fac"},
                            {"data":"voucher"},
                            {"data":"id_product"},
                            {"data":"operacion"},
                            {"data":"buy_canty"},
                            {"data":"buy_unit"},
                            {"data":"buy_total"},
                            {"data":"sales_canty"},
                            {"data":"sales_unit"},
                            {"data":"sales_total"},
                            {"data":"prom_canty"},
                            {"data":"prom_unit"},
                            {"data":"prom_total"},
                        ],*/
                        buttons: {
                            dom:{
                                button:{
                                    className: 'btn'
                                }
                            },
                            buttons:[                                
                                {
                                  extend:   'pdfHtml5',
                                  footer:   'true',             
                                  text:     '<i class="fa fa-file-pdf-o"> </i> Exportar a PDF',
                                  titleAttr: "Exportar a PDF",
                                  title:    "Lista de movimientos",
                                  className: 'btn btn-outline-warning',
                                  orientation: 'landscape',
                                  pageSize: 'A4'
                                },
                                {
                                  extend:    "excelHtml5",
                                  footer:   'true',             
                                  text:      '<i class="fa fa-file-excel-o"></i> Exportar a excel',
                                  titleAttr: "Exportar a excel",
                                  className: 'btn btn-outline-success',
                                  title:      "Lista de Movimientos",

                                    customize: function (xlsx) {
                                            console.log(xlsx);
                                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                            var downrows = 3;
                                            var clRow = $('row', sheet);
                                            //update Row
                                            clRow.each(function () {
                                                var attr = $(this).attr('r');
                                                var ind = parseInt(attr);
                                                ind = ind + downrows;
                                                $(this).attr("r",ind);
                                            });
                                      
                                            // Update  row > c
                                            $('row c ', sheet).each(function () {
                                                var attr = $(this).attr('r');
                                                var pre = attr.substring(0, 1);
                                                var ind = parseInt(attr.substring(1, attr.length));
                                                ind = ind + downrows;
                                                $(this).attr("r", pre + ind);
                                            });
                                      
                                            function Addrow(index,data) {
                                                msg='<row r="'+index+'">'
                                                for(i=0;i<data.length;i++){
                                                    var key=data[i].k;
                                                    var value=data[i].v;
                                                    msg += '<c t="inlineStr" r="' + key + index + '" s="42">';
                                                    msg += '<is>';
                                                    msg +=  '<t>'+value+'</t>';
                                                    msg+=  '</is>';
                                                    msg+='</c>';
                                                }
                                                msg += '</row>';
                                                return msg;
                                            }
                                      
                                            //insert
                                            
                                            var r1 = Addrow(1, [{ k: 'A', v: 'NOMBRE PRODUCTO' }, { k: 'B', v: ''+this.nombrep}, { k: 'C', v: '' }]);
                                            var r2 = Addrow(2, [{ k: 'A', v: 'UNIDAD DE MEDIDA' }, { k: 'B', v: ''+this.unidadp }, { k: 'C', v: '' }]);
                                            var r3 = Addrow(3, [{ k: 'A', v: 'LOCALIDAD' }, { k: 'B', v: ''+this.officep }, { k: 'C', v: '' }]);
                                             
                                            sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2+ r3+ sheet.childNodes[0].childNodes[1].innerHTML;
                                        },
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
                                }

                            ]                           
                        },                                  
                        "columnDefs": [
                            {
                                "targets": [0],
                                "visible": true
                            }
                        ],                               
                            "language":idioma_espanol,
                            select: true

                    });//end table
                //table.slice(1).remove();
                table.clear(); // borramos datos anteriores
                for (var i = 0; i < this.productos.length; i++) {
                    table.row.add([
                            this.productos[i].fecha,
                            this.productos[i].num_fac,
                            this.productos[i].voucher,
                            this.productos[i].id_product,
                            this.productos[i].operacion,
                            this.productos[i].buy_canty,
                            this.productos[i].buy_unit,
                            this.productos[i].buy_total,
                            this.productos[i].sales_canty,
                            this.productos[i].sales_unit,
                            this.productos[i].sales_total,
                            this.productos[i].prom_canty,
                            this.productos[i].prom_unit,
                            this.productos[i].prom_total,
                        ]).draw(); 
                }

                //console.log(this.productos);

                });
            },

            hidensection(sec){

                if(sec==1){
                    if(this.editactive) {
                    this.editactive=false
                    }else{
                        this.editactive=true
                    }
                }else{
                    if(this.editactive2) {
                    this.editactive2=false
                    }else{
                        this.editactive2=true
                    }
                }
                
            },

            filterprodbyid: async function(){
                let faselect =new  Date(this.finicio)
                let mes = (((faselect.getMonth()+1)<10? '0' + (faselect.getMonth()+1) : (faselect.getMonth()+1)))
                if(this.skuprod != ""){
                    this.getkardexBySku(mes,this.skuprod)
                }else{
                    this.alertSms("info", "Debe Completar campo Código/Nombre")
                }
            },

        	getkardexBySku: async function(mesactual, sku){

                let formdata = new FormData();
                	formdata.append('skuprod',sku);
                	formdata.append('fecha', mesactual);

                let url = "controllers/kardex/seachByskuController.php"
                let head = {method: 'POST', body: formdata}
                await fetch(url, head)
                .then(resp=>resp.json())
                .then(data=>{

                    let type = data[0]
                    let datos = data[1]
                    this.productos = []

                    if (type==0 || type =='0') {
                        this.editactive2 = true
                        for (var i =0; i<datos.length; i++) {
                            this.productos.push(datos[i]);
                        }
                        this.tabla()
                        this.getinfoProduct()
                    }else{
                         this.alertSms("warning", "Kardex no encontrado para el producto seleccionado.")

                    }

                   
                     
                	
                })

            },

             getinfoProduct : async  function(){
                let formdata = new FormData();
                    formdata.append('sku',this.skuprod);

                let url = 'controllers/article/getInfoProduct.php';
                let head = {method: 'POST', body: formdata}

                await fetch(url, head)
                .then(resp=>resp.json())
                .then(data=>{
                    let type = data[0]
                    let datos = data[1]
                    this.articleinfo = []
                                        
                    if (type==0 || type =='0') {
                        for (var i =0; i<datos.length; i++) {
                            this.articleinfo.push(datos[i]);
                            this.nombrep = datos[i].name
                            this.unidadp = datos[i].unidad
                            this.officep = datos[i].office
                        }
                    }else{
                         this.articleinfo = []
                         this.alertSms("warning", "Informacion del producto no encontrado")
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
        }
        }
})//end vuew