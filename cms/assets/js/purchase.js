
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
function listPurchase(){

	table = $("#table_listdata").DataTable({
        "dom": 'Bfrtip',
        "ordering":false,   
        "bLengthChange":false,
        "searching": { "regex": false },
        "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"] ],
        "pageLength": 20,
        "destroy":true,
        "async": false ,
        "processing": true,
       
       "buttons": [
            {
              extend:    "print",footer: 'true',                         
              text:      '<i class="btn-xs fa fa-print" style="color: #0070FFFF; font-size: 18px;"></i> Imprimir',
              titleAttr: "Imprimir Productos",
              title:     "Lista de productos",
              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,5] }
            },
            {
              extend:    "excelHtml5",footer: 'true',             
              text:      '<i class="fa fa-file-excel-o" style="color: #059C00FF; font-size: 16px;"></i> Exportar a excel',
              titleAttr: "Exportar a excel",
              title:      "Lista de productos",
              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,5] }
            },
            {
              extend:   'pdfHtml5',footer: 'true',             
              text:     '<i class="fa fa-file-pdf-o" style="color: #FF3F00FF; font-size: 16px;"> </i> Exportar a PDF',
              titleAttr: "Exportar a PDF",
              title:    "Lista de productos",
              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,5] }
            },
            {
              extend:   'csvHtml5',footer: 'true',             
              text:     '<i class="fa fa-file-text-o" style="color: #0094FFFF; font-size: 16px;"></i> Exportar a CSV',
              titleAttr: "Exportar a CSV",
              title:    "Lista de productos",
              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,5] }
            },
            {
              extend:   'copyHtml5',footer: 'true',             
              text:     '<i class="fa fa-file-text-o" style="color: #FF006EFF; font-size: 16px;"></i> Copiar a Portapapel',
              titleAttr: "Copiar a Portapapel",
              title:    "Lista de productos",
              exportOptions: { columns: [ 0, 1, 2, 3, 4,5,5] }
            }
        ],
       "columnDefs": [
            {
                "targets": [1],
                "visible": false
            }
        ],
       "ajax":{
           "url":"controllers/article/articleController.php",
           "type":'POST',
           "dataSrc": "data",
           error: function (e) {
                console.log(e);
            }

       },
       "columns":[
          {"data":"item"},
          {"data":"sku"},
          {"data":"article"},
          {"data":"price",
            render: function(data, type, row){
              return '<span class="badge badge-success">$ </span>'+row.price;
            }
          },
          {"data":"category"},
          {"data":"unidad"},         
          {"data":"marca"},
          {"data":"quantity" },
             
          {"defaultContent": "No generated",

           render: function (data, type, row ) {
               if(row.state=='1'){
                  return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i>&nbsp;Editar</button>"                   ;
               }else{
                  return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i>&nbsp;Editar</button>";
               }
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

function filterGlobal(){
    $("#table_listdata").DataTable().search(
        $("#global_filter").val(),
      ).draw();
}
/**
 * Muestra modal para registrar nuevo artículos
 */

function AbrirModalMedico(){
  $("#modal_editupdate").modal("show")
  $("#modal_editupdate").modal({backdrop:'static', keyboard:false}) 
  $("#newarticle").val('0')
  $(".secodigo").removeAttr('style')
  $(".secestado").css({"display":"none"})

  $("#skua").val("")
  $("#namea").val("")
  $("#pricea").val("")
  $("#cantya").val("")
  listCombos("controllers/category/listCategory.php", "cbcat")
  listCombos("controllers/size/listSizeController.php", "cbsize")
  listCombos("controllers/marca/listMarcaController.php", "cbmarca")
    
  $(".btnsave").html("Guardar Compras")
  
}

function validateinput(e){
   var res = /^\d*(\.\d{1})?\d{0,1}$/;
   
   
}

/**
 * editar Articulo
 */
$("#table_listdata").on('click','.editar',function(){
    var obj = table.row($(this).parents('tr')).data()
    if(table.row(this).child.isShown()){
      var obj = table.row(this).data()
    }
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
    $("#cbcat").val(obj.id_category).trigger("change")
    $("#cbsize").val(obj.id_unidad).trigger("change")
    $("#cbmarca").val(obj.id_marca).trigger("change")
    $("#cbstate").val(obj.state).trigger("change")
    
    listCombos("controllers/category/listCategory.php", "cbcat")
    listCombos("controllers/size/listSizeController.php", "cbsize")
    listCombos("controllers/marca/listMarcaController.php", "cbmarca")
    
    $(".btnsave").html("Actualizar Compra")
})

/**
 * Listamos los combos del formulario
 */
function listCombos(pathApi,cbo){
  let url = pathApi
  let datos = new FormData();
  datos.append("id", 1);
  var options = "";
  let category = getApiData(url,datos)
  category.then(ps=>{
    var resul = ps['data']
    if(resul.length>0){
      for (var i = 0; i < resul.length; i++) {
          options +="<option value='"+resul[i].id+"'>"+resul[i].name+"</option>";
      }      
    }else{
       options="<option value='0'>No hay datos Disponibles</option>";
    } 

    $("#"+cbo).html(options)   
  })
  
}


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

    let datos= new FormData()

        datos.append("skua",skua)
        datos.append("namea",namea)
        datos.append("pricea",pricea)
        datos.append("cantya",cantya)
        datos.append("cbcat",cbcat)
        datos.append("cbsize",cbsize)
        datos.append("cbmarca",cbmarca)
        datos.append("cbstate",cbstate)


        let resul = getApiData(url,datos)
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
