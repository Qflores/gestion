
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
function listWorker(){

	table = $("#table_listdata").DataTable({
        "dom": 'Blfrtip',
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
            'pdfHtml5',
            'print'
        ],
       "columnDefs": [
            {
                "targets": [3],
                "visible": false
            }
        ],
       "ajax":{
           "url":"controllers/worker/listWorkerController.php",
           "type":'POST',
           "dataSrc": "data",
           error: function (e) {
                //console.log(e);
            }

       },
       "columns":[
          {"data":"names"},
          {"data":"email"},
          {"data":"phone"},
          {"data":"address"},
          {"data":"role",
              render: function (data, type, row ) {               
                 if(row.role =='worker'){
                  return "Cajero";
                }else{
                  return row.role;
                }
              }
          },         
          {"data":"state",
            render: function (data, type, row ) {               
                 if(row.state =='1'){
                  return "<span class='text-success'>Activo</span>";
                }else{
                  return "<span class='text-danger'>Desabilitado</span>";
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
  $("#userid").val('0')

  $(".secestado").css({"display":"none"})
  $(".secpass1").removeAttr('style')
  $(".secpass2").removeAttr('style')
  $("#usernames").removeAttr('readonly')

  $("#namec").val("")
  $("#emailc").val("")
  $("#phonec").val("")  
  $("#docc").val("")  
  $("#addressc").val("")  
  $("#usernames").val("")
  $("#pass1").val("")
  $("#pass2").val("")

  $("#cbstate").val("1").trigger("change")    
  $(".btnsave").html("Guardar Usuario")
  
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
    $(".secpass1").css({"display":"none"})
    $(".secpass2").css({"display":"none"})
    $("#usernames").attr('readonly','readonly')

    $("#idc").val(obj.personid)
    $("#userid").val(obj.userid)

    $("#namec").val(obj.names)
    $("#emailc").val(obj.email)
    $("#phonec").val(obj.phone)
    $("#docc").val(obj.document)
    $("#addressc").val(obj.address)
    $("#usernames").val(obj.username)

    $("#cbstate").val(obj.state).trigger("change")
    
    $(".btnsave").html("Actualizar Usuario")
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
    let url = "controllers/worker/iuWorkerController.php";
    let idc =$("#idc").val()
    let userid =$("#userid").val()

    let namec    =$("#namec").val()    
    let emailc  =$("#emailc").val()
    let phonec   =$("#phonec").val()
    let docc   =$("#docc").val()
    let addressc  =$("#addressc").val()

    let username ="";
    let pass1 ="";
    let pass2 ="";
    let cbstate="";

    if(idc=='0' || idc ==0){
      //si es nuevo
      username  =$("#usernames").val()
      cbstate ='1';
      pass1  =$("#pass1").val()
      pass2  =$("#pass2").val()

      if(pass1!==pass2){
        alertSms("info","la contraseña no coincide")
        //romper la ejecucion
        return false;;
      }

      if(username=="" || username.length<5){
        alertSms("info","El usuario minimo de 5 dígitos")
        //romper la ejecucion
        return false;
      }

      
    }else{
      username  ="";
      pass1  ="";
      pass2  ="";
      cbstate =$("#cbstate").val()
    }

    
    let datos= new FormData()
        datos.append("idc",idc)
        datos.append("names",namec)
        datos.append("email",emailc)
        datos.append("phone",phonec)
        datos.append("docc",docc)
        datos.append("address",addressc)
        datos.append("username",username)
        datos.append("pass1",pass1)
        datos.append("pass2",pass2)
        datos.append("userid",userid)
        datos.append("state",cbstate)

        let resul = getApiData(url,datos)
        resul.then(ps=>{

          if(ps==true && idc !="0"){
            alertSms('success','Datos del Usuario se Actualizó')
            $("#modal_editupdate").modal("hide")            
              table.ajax.reload();
          }else if(ps==true && idc=="0"){            
            alertSms('success','Datos del Usuario se Guardó')
            $("#modal_editupdate").modal("hide")
              table.ajax.reload();              
          }else{
            alertSms("error","<h3>El usuario no se Guardó</h3><br> <span class='text-danger'>"+ps+"</span>")
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
