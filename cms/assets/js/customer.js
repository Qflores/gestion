
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
function listCustomer(){

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
              title:     "Lista de Clientes",
              exportOptions: { columns: [ 0, 1, 2, 3, 4] }
            },
            {
              extend:    "excelHtml5",footer: 'true',             
              text:      '<i class="fa fa-file-excel-o" style="color: #059C00FF; font-size: 16px;"></i> Exportar a excel',
              titleAttr: "Exportar a excel",
              title:      "Lista de Clientes",
              exportOptions: { columns: [ 0, 1, 2, 3, 4] }
            },
            {
              extend:   'pdfHtml5',footer: 'true',             
              text:     '<i class="fa fa-file-pdf-o" style="color: #FF3F00FF; font-size: 16px;"> </i> Exportar a PDF',
              titleAttr: "Exportar a PDF",
              title:    "Lista de Clientes",
              exportOptions: { columns: [ 0, 1, 2, 3, 4] }
            },
            {
              extend:   'csvHtml5',footer: 'true',             
              text:     '<i class="fa fa-file-text-o" style="color: #0094FFFF; font-size: 16px;"></i> Exportar a CSV',
              titleAttr: "Exportar a CSV",
              title:    "Lista de Clientes",
              exportOptions: { columns: [ 0, 1, 2, 3, 4] }
            },
            {
              extend:   'copyHtml5',footer: 'true',             
              text:     '<i class="fa fa-file-text-o" style="color: #FF006EFF; font-size: 16px;"></i> Copiar a Portapapel',
              titleAttr: "Copiar a Portapapel",
              title:    "Lista de Clientes",
              exportOptions: { columns: [ 0, 1, 2, 3, 4] }
            }
        ],
       "columnDefs": [
            {
                "targets": [3],
                "visible": false
            }
        ],
       "ajax":{
           "url":"controllers/customer/listAllCustomerController.php",
           "type":'POST',
           "dataSrc": "data",
           error: function (e) {
                console.log(e);
            }

       },
       "columns":[
          {"data":"names"},
          {"data":"email"},
          {"data":"phone"},
          {"data":"document"},
          {"data":"address"},         
          {"data":"state",
             render: function (data, type, row ) {
               if(row.state=='1'){
                  return "<span class='text-success'>Activo</span>";
               }else{
                  return "<span class='text-danger'>Inactivo</span>";
               }
             }

        },
             
          {"defaultContent": "No generated",
            render: function (data, type, row ) {               
                  return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i>&nbsp;Editar</button>";
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

function AbrirModal(){
  $("#modal_editupdate").modal("show")
  $("#modal_editupdate").modal({backdrop:'static', keyboard:false}) 
  $("#idc").val('0')
  $(".secodigo").removeAttr('style')
  $(".secestado").css({"display":"none"})
  
  $("#namec").val("")
  $("#emailc").val("")
  $("#phonec").val("")  
  $("#docc").val("")  
  $("#addressc").val("")  
  $("#cbstate").val(1)   
  $(".btnsave").html("Guardar Cliente")
  
}

function validateinput(e){
   var RE = /^\d*(\.\d{1})?\d{0,1}$/;
   }

/**
 * editar cliente
 */
$("#table_listdata").on('click','.editar',function(){
    var obj = table.row($(this).parents('tr')).data()
    if(table.row(this).child.isShown()){
      var obj = table.row(this).data()
    }
    //evitamos cerrar el modal
    $("#modal_editupdate").modal({backdrop:'static', keyboard:false})
    $("#modal_editupdate").modal("show")    
    $(".secestado").removeAttr('style')

    $("#idc").val(obj.id)
    $("#namec").val(obj.names)
    $("#emailc").val(obj.email)
    $("#phonec").val(obj.phone)
    $("#docc").val(obj.document)
    $("#addressc").val(obj.address)
    $("#cbstate").val(obj.state).trigger("change")
    
    $(".btnsave").html("Actualizar Cliente")
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
    let url = "controllers/customer/iuCustomerController.php";
    let idc =$("#idc").val()
    let namec    =$("#namec").val()    
    let emailc  =$("#emailc").val()
    let phonec   =$("#phonec").val()
    let docc   =$("#docc").val()
    let addressc  =$("#addressc").val()
    let cbstate =$("#cbstate").val()

    
    let datos= new FormData()
        datos.append("idc",idc)
        datos.append("emailc",emailc)
        datos.append("namec",namec)
        datos.append("phonec",phonec)
        datos.append("docc",docc)
        datos.append("addressc",addressc)
        datos.append("cbstate",cbstate)


        let resul = getApiData(url,datos)
        resul.then(ps=>{
          if(ps==true && idc !="0"){
            alertSms('success','Datos del cliente se Actualizó')
            $("#modal_editupdate").modal("hide")            
              table.ajax.reload();
          }else if(ps==true && idc=="0"){            
            alertSms('success','Datos del cliente se Guardó')
            $("#modal_editupdate").modal("hide")
              table.ajax.reload();              
          }else{
            alertSms("error","<h3>El Cliente no se Guardó</h3><br> <span class='text-danger'>"+ps+"</span>")
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
