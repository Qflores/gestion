
/*peticiones fetch al servidor */
async function getApiData(url, datos){
	let resul = await fetch(url,{
		method: 'POST',
		body: datos
	})
	.then(converdata=>converdata.json())
	.then(resp=>resp)
	return resul;
}


var table;
function listArticles(namea, limit){

	table = $("#table_listdata").DataTable({        
        "ordering":true,   
        "LengthChange":true,
        "LengthMenu" : true,
        "bInfo": true,
        "searching": { "regex": true },
        "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Todo"] ],
        "pageLength": 25,
        "destroy":true,
        "async": false ,
        "order": [[ 0, "asc" ]],
        "processing": true, 
        "dom": 'Blfrtip',         
        "buttons": {
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
                        title:     "Lista de Artículos",
                        className: 'btn btn-outline-primary',
                        exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
                      },
                      {
                        extend:    "excelHtml5",footer: 'true',             
                        text:      '<i class="fa fa-file-excel-o"></i> Exportar a excel',
                        titleAttr: "Exportar a excel",
                        className: 'btn btn-outline-success',
                        title:      "Lista de Artículos",
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
                        },
                        exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
                      },
                      {
                        extend:   'pdfHtml5',footer: 'true',             
                        text:     '<i class="fa fa-file-pdf-o"> </i> Exportar a PDF',
                        titleAttr: "Exportar a PDF",
                        title:    "Lista de Artículos",
                        className: 'btn btn-outline-warning',
                        exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
                      },
                      {
                        extend:   'csvHtml5',footer: 'true',             
                        text:     '<i class="fa fa-file-text-o"></i> Exportar a CSV',
                        titleAttr: "Exportar a CSV",
                        title:    "Lista de Artículos",
                        className: 'btn btn-outline-info',
                        exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
                      },
                      {
                        extend:   'copyHtml5',footer: 'true',             
                        text:     '<i class="fa fa-file-text-o"></i> Copiar a Portapapel',
                        titleAttr: "Copiar a Portapapel",
                        title:    "Lista de Artículos",
                        className: 'btn btn-outline-danger',
                        exportOptions: { columns: [ 0, 1, 2, 3, 4,5,6] }
                      }

              ]                   
        },
       "columnDefs": [//ocultar columna
            {
                "targets": [1],
                "visible": true
            }
        ],
       "ajax":{
           "url":"controllers/article/articleController.php",
           "type":'POST',
           "data": {skuname:namea,long:limit},
           "dataSrc": "data",
           error: function (e) {
                //console.log(e);
            }

       },
       "columns":[          
          {"data":"sku"},
          {"data":"article"},
          {"data":"price",
            render: function(data, type, row){
              return '<span class="badge badge-success" style="padding: 5px;font-size: 100%; background-color: #17a2b8;">'+row.price+'</span>';
            }
          },
          {"data":"category"},
          {"data":"quantity" },
          {"data":"unidad"},         
          {"data":"marca"},
          {"defaultContent": "No generated",
           render: function (data, type, row ) {
               
                  let img = "<button style='font-size:13px;' type='button' class='photoimg btn btn-outline-info'><i class='fa fa-photo'></i>&nbsp;Imagen</button>";
                  return "<button style='font-size:13px;' type='button' class='editar btn btn-outline-primary'><i class='fa fa-edit'></i>&nbsp;Editar</button> " + img;
              
             }
          },           
       ],

       "language":idioma_espanol,
       select: true
   });


   document.getElementById("table_listdata_filter").style.display="none";
   
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    });

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });



}

/**
 * [newCategory and list category]
 */
function newUnidad(){
    $("#secunidadlist" ).removeClass( "input-group d-display" ).addClass( "input-group d-none" );
    $("#secunidadadd" ).removeClass( "input-group d-none" ).addClass( "input-group d-display" );
}
function listUnidad(type){
    
  if (type) {

    let newunidad =$("#newunidad").val();
    let newsymbol =$("#newsymbol").val();

    if(newunidad!="" && newsymbol!=""){

      let url = "controllers/size/iuMedidaController.php"
      let datos = new FormData();
          datos.append("name",newunidad);
          datos.append("symbol",newsymbol);

      let result = getApiData(url,datos)
          result.then(request=>{

            if(request[0]==0|| request[0]=='0'){
              console.log(request[1]);
              alertSms("success",''+request[1])
              $("#newunidad").val('');
              $("#newsymbol").val('');
              $("#secunidadlist").removeClass("input-group d-none").addClass("input-group d-display");
              $("#secunidadadd").removeClass("input-group d-display").addClass("input-group d-none");
              listCombos("controllers/size/listSizeController.php", "cbsize")
            }else{
              alertSms("error",request[1])
            }
            
          })

    }else{
      alertSms("info","Debe Ingresar nombre de Unidade de medida")
    }

  }else{
    $("#newunidad").val('');
    $("#newsymbol").val('');
    $("#secunidadlist" ).removeClass( "input-group d-none" ).addClass( "input-group d-display");
    $("#secunidadadd" ).removeClass( "input-group d-display" ).addClass( "input-group d-none");
  }
    
    
}
/**
 * [newCategory and Listcategory]
 */
function newCategory(){
    $("#seccategorylist").removeClass("input-group d-display").addClass( "input-group d-none");
    $("#seccategoryadd").removeClass("input-group d-none").addClass( "input-group d-display");
}
function listCategory(type){
    if (type) {

      let newcategory =$("#newcategory").val();

      if(newcategory!=""){

        let url = "controllers/category/iuCategoryController.php"
        let datos = new FormData();
            datos.append("name",newcategory);

        let result = getApiData(url,datos)
            result.then(request=>{
              if(request[0]==0|| request[0]=='0'){
                console.log(request[1]);
                alertSms("success",''+request[1])
                $("#newcategory").val('');
                $("#seccategorylist").removeClass("input-group d-none").addClass("input-group d-display");
                $("#seccategoryadd").removeClass("input-group d-display").addClass("input-group d-none");
                listCombos("controllers/category/listCategory.php", "cbcat")
              }else{
                alertSms("error",request[1])
              }
              
            })

      }else{
        alertSms("info","Debe Ingresar nombre de Categoría")
      }

  }else{
    $("#newcategory").val('');
    $("#seccategorylist").removeClass("input-group d-none").addClass("input-group d-display");
    $("#seccategoryadd").removeClass("input-group d-display").addClass("input-group d-none");
  }
    
}
/**
 * [newUnidad and listmarca]
 */
function newMarca(){
    $("#secmarcalist" ).removeClass( "input-group d-display" ).addClass( "input-group d-none" );
    $("#secmarcaadd" ).removeClass( "input-group d-none" ).addClass( "input-group d-display" );
}
function listMarca(type){

    if (type) {

      let newmarca =$("#newmarca").val();

      if(newmarca!=""){

        let url = "controllers/marca/iuMarcaController.php"
        let datos = new FormData();
            datos.append("name",newmarca);

        let result = getApiData(url,datos)
            result.then(request=>{
              if(request[0]==0|| request[0]=='0'){
                console.log(request[1]);
                alertSms("success",''+request[1])
                $("#newmarca").val('');
                $("#secmarcalist").removeClass("input-group d-none").addClass("input-group d-display");
                $("#secmarcaadd").removeClass("input-group d-display").addClass("input-group d-none");
                listCombos("controllers/marca/listMarcaController.php", "cbmarca")
              }else{
                alertSms("error",request[1])
              }
              
            })

      }else{
        alertSms("info","Debe Ingresar nombre de Marca")
      }

  }else{
    $("#newcategory").val('');
    $("#secmarcalist").removeClass("input-group d-none").addClass("input-group d-display");
    $("#secmarcaadd").removeClass("input-group d-display").addClass("input-group d-none");
  }
}

/**
 * [filterGlobal description]
 */
function filterGlobal(){
    $("#table_listdata").DataTable().search(
        $("#global_filter").val(),
      ).draw();
}

$("#global_filter").on('keypress',function(e){
    if (e.which == 13 || e.keyCode == 13) {        
      filterArticleBynameLimit()
    }    
})

function filterArticleBynameLimit(){
    let name = $("#global_filter").val()
    let limit = $('#table_listdata').DataTable().page.info().length 
    listArticles(name, limit)
}


/**
 * Muestra modal para registrar nuevo artículos
 */

function AbrirModal(){
  $("#modal_editupdate").modal("show")
  //evitamos cerrar el modal
  $("#modal_editupdate").modal({backdrop:'static', keyboard:false})
  //reset form productos
  $("#formproductos")[0].reset();  
  
  $("#impa").removeAttr('checked'); //reset checked
  $("#stock").removeAttr('checked');
  $("#stock").attr('disabled',false) 
  
  $("#newarticle").val('0')
  $(".secodigo").removeAttr('style')
  $(".secestado").css({"display":"none"})
  $("#skua").val("")
  $("#namea").val("")
  $("#pricea").val("")
  $("#cantya").val("")
  $("#priceab").val("")  
  $("#isca").val("")
  $("#mina").val("")
  $("#maxa").val("")
  $("#sizea").val("")



  listCombos("controllers/category/listCategory.php", "cbcat")
  listCombos("controllers/size/listSizeController.php", "cbsize")
  listCombos("controllers/marca/listMarcaController.php", "cbmarca")
    
  $(".btnsave").html("Guardar Artículo")
  
}
/**
 * editar Articulo
 */
$("#table_listdata").on('click','.editar',function(){
    var obj = table.row($(this).parents('tr')).data()
    if(table.row(this).child.isShown()){
      var obj = table.row(this).data()
    }    
    //reset form productos
    $("#formproductos")[0].reset();
    //evitamos cerrar el modal
    $("#modal_editupdate").modal({backdrop:'static', keyboard:false})
    $("#modal_editupdate").modal("show")
    $(".secodigo").css({"display":"none"})
    $(".secestado").removeAttr('style')

    $("#newarticle").val(obj.sku)
    $("#skua").val(obj.sku)
    $("#namea").val(obj.article)
    $("#pricea").val(obj.price)
    $("#cantya").val(obj.quantity)

    $("#stock").removeAttr('checked');

    //console.log("kardex: " + obj.stock);

    if(obj.stock>0){
      $("#stock").attr('checked',true)
      $("#stock").attr('disabled','true')
    }else{
      $("#stock").attr('checked',false) 
      $("#stock").attr('disabled',false)   
    }
    
    
    $("#impa").removeAttr('checked'); //reset checked
    if(obj.iva>0){      
      $("#impa").attr('checked',true)
    }else{
      $("#impa").attr('checked',false)
    }

    $("#priceab").val(obj.pricebuy)
    $("#isca").val(obj.isc)
    $("#mina").val(obj.min)
    $("#maxa").val(obj.max)
    $("#sizea").val(obj.size)

    $("#cbcat").val(obj.id_cat).trigger("change")
    $("#cbsize").val(obj.id_unidad).trigger("change")
    $("#cbmarca").val(obj.id_marca).trigger("change")
    $("#cbstate").val(obj.state).trigger("change")
        
    listCombos("controllers/category/listCategory.php", "cbcat",obj.id_cat)
    listCombos("controllers/size/listSizeController.php", "cbsize",obj.id_unidad)
    listCombos("controllers/marca/listMarcaController.php", "cbmarca",obj.id_marca)
    
    
    $(".btnsave").html("Actualizar Artículo")
})

/**
 * [description] show modal for u0pload img
 */
$("#table_listdata").on('click','.photoimg',function(){

    
    var obj = table.row($(this).parents('tr')).data()
    if(table.row(this).child.isShown()){
      var obj = table.row(this).data()
    } 

    //reset form productos
    $("#formartphoto")[0].reset();
    //evitamos cerrar el modal
    $("#modalphotoarticle").modal({backdrop:'static', keyboard:false})
    $("#modalphotoarticle").modal("show")
    $(".secodigo").css({"display":"none"})

    $("#skuart").val(obj.sku)
    $("#imgnameprod").html(''+obj.article)

    let formdata = new FormData();
        formdata.append("sku", obj.sku)

    let url = "controllers/article/listAllPictureArticleController.php";

    let resul = getApiData(url, formdata)
        resul.then(ps=>{

            let type = ps[0]
            let data = ps[1]
            let divimg= "";
            let rutaimg = "assets/images/";

            if(type==0){
              for (var i = 0; i<data.length ; i++) {
                divimg += '<img class="img-fluid" src="'+rutaimg+data[i].path+'" id="imgarticle"> <span class="btn btn-outline-danger" onclick="deletepicture('+data[i].id+',\''+data[i].path+'\')" >Eliminar</span> <br>';
                
              }

              $("#secimg").html(''+divimg);

            }else{
              $("#secimg").html("<h3>no hay imagen para mostrar</h3>");
            }
            
    })
    
});

function deletepicture(idpicture,file){

  let url = "controllers/article/deletePitureController.php";
  
  console.log(idpicture);
  console.log(file);

  let formdata = new FormData();
        formdata.append("idpic", idpicture)
        formdata.append("file", file)
   let resul = getApiData(url, formdata)
        resul.then(ps=>{
          let type = ps[0]
          let sms = ps[1]
          if(type ==0){
             this.alertSms("success",'Imagen actualizado');
             $("#modalphotoarticle").modal("hide")
          }else{
            this.alertSms("error",sms);
          }

        })     

}

function uploadimg(){
  //fileimg1
  let imgart =  $("#fileimg1")[0].files[0]
  let idart =  $("#skuart").val()
  let url = "controllers/article/uploadImgArticleController.php";


  let formdata = new FormData();
      formdata.append("photo", imgart)
      formdata.append("sku", idart)
 
  if(idart !="" && imgart != undefined){
    let resul = getApiData(url, formdata)
        resul.then(ps=>{

          let type = ps[0]
            let data = ps[1]
            let divimg= "";
            let rutaimg = "assets/images/";

            if(type==0){
              
              divimg = '<img src="'+rutaimg+data+'" id="imgarticle" width="600" height="600">';

              $("#secimg").html(''+divimg);
              this.alertSms("success",'Imagen Subido');
            }else{
              this.alertSms("error",data);
              $("#secimg").html("<h3>Archivo no guardado</h3>");
            }
        })
  }else{
    this.alertSms("info", "debe adjuntar una imagen");
  }
  

}

/**
 * Listamos los combos del formulario
 */
function listCombos(pathApi,cbo, id){
  let url = pathApi
  let datos = new FormData();
  datos.append("id", 1);
  var options = "";
  let category = getApiData(url,datos)
  category.then(ps=>{
    var resul = ps['data']
    if(resul.length>0){
      for (var i = 0; i < resul.length; i++) {
        if(resul[i].id == id){
          options +="<option selected value='"+resul[i].id+"'>"+resul[i].name+"</option>";
        }else{
          options +="<option value='"+resul[i].id+"'>"+resul[i].name+"</option>";
        }          
      }      
    }else{
       options="<option value='0'>No hay datos Disponibles</option>";
    } 

    $("#"+cbo).html(options)
  })
}//end List Con¿mbo


function saveObjData(){
    let url = "controllers/article/iuarticleController.php";
    let skua    =$("#skua").val()
    let namea   =$("#namea").val()
    let pricea  =$("#pricea").val()
    let cantya  =$("#cantya").val()
    let cbcat   =$("#cbcat").val()
    let cbsize  =$("#cbsize").val()
    let cbmarca =$("#cbmarca").val()
    let cbstate =$("#cbstate").val()
    let newarticle =$("#newarticle").val()

    let priceab =$("#priceab").val()
    let impa =$("#impa").val()  
    let isca =$("#isca").val()
    let mina =$("#mina").val()
    let maxa =$("#maxa").val()
    let sizea =$("#sizea").val()
    let stock =$("#stock").val()

    var miCheckbox = document.getElementById('impa');
    if(miCheckbox.checked){
      impa = 1;
    }else{
      impa = 0;
    }
    
    var miStock = document.getElementById('stock');
    if(miStock.checked){
      stock = 1;
    }else{
      stock = 0;
    }

    if(stock == 1 && cantya=="" || stock == 1 && priceab==""){
      alertSms('info','Para Aperturar kardex se requiere precio de compra y la cantidad');

    }else{

      if(skua=="" || namea=="" || cantya=="" || pricea=="" ){

        alertSms('info','Complete los Campos Obligatorios');

      }else{


      let datos= new FormData()

          datos.append("skua",skua)
          datos.append("namea",namea)
          datos.append("pricea",pricea)
          datos.append("cantya",cantya)
          datos.append("cbcat",cbcat)
          datos.append("cbsize",cbsize)
          datos.append("cbmarca",cbmarca)
          datos.append("cbstate",cbstate)
          datos.append("newarticle",newarticle)

          datos.append("priceab",priceab)
          datos.append("impa",impa)
          datos.append("isca",isca)
          datos.append("mina",mina)
          datos.append("maxa",maxa)
          datos.append("sizea",sizea)
          datos.append("stock",stock)

          
          let resul = getApiData(url, datos)
          resul.then(ps=>{
            
            if(ps==true && newarticle !="0"){
              alertSms('success','El articulo se Actualizó')
              $("#modal_editupdate").modal("hide")            
                table.ajax.reload();
            }else if(ps==true && newarticle=="0"){            
              alertSms('success','El articulo se Guardó')
              $("#modal_editupdate").modal("hide")
                table.ajax.reload();
            }else{
              alertSms("error","<h3>El articulo no se Guardó</h3><br> <span class='text-danger'>"+ps+"</span>")
            }
          })

        }
      }
}

function alertSms(typoaler,sms){
    Swal.fire({ position: 'top-center',
    icon: typoaler,
    title: sms,
    showConfirmButton: false,              
    timer: 1500,
    timerProgressBar: true,
    onBeforeOpen: ()=>{
      Swal.showLoading()
    }
  });
}
