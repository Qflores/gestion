
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
function listSupplier(){

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
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
       "columnDefs": [
            {
                "targets": [2],
                "visible": false
            },
            {
                "targets": [3],
                "visible": false
            },
            {
                "targets": [6],
                "visible": false
            }
        ],
       "ajax":{
           "url":"controllers/supplier/listAllSupplierController.php",
           "type":'POST',
           "dataSrc": "data",
           "dataType": 'json',
           headers: {
              "Authorization": "Bearer "
            },
           error: function (e) {
                console.log(e);
            }

       },
       "columns":[
          {"data":"company"},
          {"data":"address"},
          {"data":"tipodoc"},
          {"data":"numdoc"},
          {"data":"phone"},
          {"data":"email"},         
          {"data":"seriedoc"},
          {"data":"moneda" },
             
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
  $("#newsupplier").val('0')
  //$(".secestado").css({"display":"none"})
  $("#namep").val("")
  $("#addressp").val("")
  $("#cbtipodoc").val(1)
  $("#phonep").val("")
  $("#emailp").val("")
  $("#serp").val("")
  $("#cbmoney").val(1)

  listCombos("controllers/money/listMoneyController.php", "cbmoney")    
  $(".btnsave").html("Guardar Proveedor")
  
}

function validateinput(e){
   var RE = /^\d*(\.\d{1})?\d{0,1}$/;
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
    //$(".secodigo").css({"display":"none"})
    //$(".secestado").removeAttr('style')
    $("#newsupplier").val(obj.id)
    $("#namep").val(obj.company)
    $("#addressp").val(obj.address)
    $("#cbtipodoc").val(obj.tipodoc).trigger("change")
    $("#nump").val(obj.numdoc)
    $("#phonep").val(obj.phone)
    $("#emailp").val(obj.email)
    $("#serp").val(obj.seriedoc)
    $("#cbmoney").val(obj.id_money).trigger("change")
    
    listCombos("controllers/money/listMoneyController.php", "cbmoney")    
    $(".btnsave").html("Actualizar Proveedor")
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
    let url = "controllers/supplier/iuSupplierController.php";
    let ids    =$("#newsupplier").val()
    let namep   =$("#namep").val()
    let addressp  =$("#addressp").val()
    let cbtipodoc  =$("#cbtipodoc").val()
    let nump   =$("#nump").val()
    let phonep  =$("#phonep").val()
    let emailp =$("#emailp").val()
    let serp =$("#serp").val()
    let cbmoney =$("#cbmoney").val()

    let datos= new FormData()

        datos.append("id",ids)
        datos.append("namep",namep)
        datos.append("addressp",addressp)
        datos.append("tipodoc",cbtipodoc)
        datos.append("nump",nump)
        datos.append("phonep",phonep)
        datos.append("emailp",emailp)
        datos.append("serp",serp)
        datos.append("idmoney",cbmoney)

        let resul = getApiData(url,datos)

        resul.then(ps=>{
          
          if(ps==true && ids !="0"){
            alertSms('success','El proveedor se Actualizó')
            $("#modal_editupdate").modal("hide")            
             table.ajax.reload();
          }else if(ps==true && ids=="0"){
            //console.log("resp:"+ps)
            alertSms('success','El proveedor se Guardó')
            $("#modal_editupdate").modal("hide")
              table.ajax.reload();
          }else{
            alertSms("error","<h3>El Proveedor no se Guardó</h3><br> <span class='text-danger'>"+ps+"</span>")
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
