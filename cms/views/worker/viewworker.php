<!-- Cargamos js que corresponde a vista de articulos -->

<script src="assets/js/worker.js"></script>
<div class="col-md-12 col-sm-12 ">
    <div class="dashboard_graph">
       
    <!-- Title secction -->
    <div class="row x_title">
        <div class="col-md-6">
          <h3>Mantenimiento de Usuarios</h3>
        </div>
        <div class="col-md-6">
          <h2>LISTA DE USUARIOS</h2>
        </div>
    </div>
          <!-- /.box-tools -->
        
        <!-- /.box-header -->
        
          <div class="form-group">
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingrese el nombre de usuario">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>            
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" style="width: 100%" onclick="AbrirModal()"> <i class="glyphicon glyphicon-plus"></i>Nuevo Usuario</button>
            </div>              
          </div>
                          
                <div class="panel-body">
                    <table id="table_listdata" class="table table-bordered dt-responsive nowrap table-td-valign-middle" style="width:100%">

                    <thead class="bg-info text-white">
                        <tr>
                            <th>Nombre de Usuario</th>
                            <th>Correo</th>
                            <th>Teléfono</th>                            
                            <th>Dirección</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                    <tfoot class="bg-info text-white">
                        <tr>
                            <th>Nombre de Usuario</th>
                            <th>Correo</th>
                            <th>Teléfono</th>                            
                            <th>Dirección</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    </table>
            </div>
        </div>
</div>


<!-- modal for inser and update -->
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade " id="modal_editupdate" role="dialog"> 
        <div class="modal-dialog modal-lg modal-dialog-top ">
            <div class="modal-content">
              
              <div class="modal-header bg-info">  
                <h3 class="modal-title text-white"><b>FORMULARIO DE USUARIO</b></h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
              </div>

              <div class="modal-body">
                <input type="hidden" value="0" id="idc">          
                <input type="hidden" value="0" id="userid">          
                
                <div class="form-group row" >
                    <label class="col-sm-3 col-form-label" for="form-label">Nombe completo: <span class="required text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control is-valid" id="namec" placeholder="Ingrese nombre completo" maxlength="80" minlength="10" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Email: <span class="required text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="email" id="emailc" min="0" maxlength="20" class="form-control is-valid"  placeholder="Ingrese su correo">
                    </div>                        
                </div>                

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Telefono: </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="phonec" placeholder="Ingrese su teléfono"  minlength="3" maxlength="100" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Documento: </label>
                    <div class="col-sm-9">
                        <input type="number" id="docc" min="8" maxlength="15" class="form-control"  placeholder="Ingrese N° de Documento"> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Dirección: </label>
                    <div class="col-sm-9">
                         <input type="text" id="addressc" min="0" maxlength="55" class="form-control"  placeholder="Ingrese su direccion">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Usuario: </label>
                    <div class="col-sm-9">
                         <input type="text" id="usernames" min="0" maxlength="55" class="form-control is-valid"  placeholder="Ingrese un usuario">
                    </div>
                </div>

                <div class="form-group row secpass1">
                    <label class="col-sm-3 col-form-label" for="form-label">Ingrese una contraseña</label>
                    <div class="col-sm-9">
                        <input type="password" id="pass1" min="0" maxlength="20" class="form-control is-valid"  placeholder="Ingrese una contraseña"> 
                        <span style="position: absolute;right: 46px;top: 2px;color: #0c515c;font-size: 26px;" onclick="hideshow()" ><i id="slash" class="fa fa-eye-slash"></i><i id="eye" class="fa fa-eye"></i></span> 
                    </div>
                </div>
                <div class="form-group row secpass2">
                    <label class="col-sm-3 col-form-label" for="form-label">Repita la contraseña: </label>
                    <div class="col-sm-9">
                        <input type="password" id="pass2" min="0" maxlength="20" class="form-control is-valid"  placeholder="Repita a contraseña">  
                    </div>
                </div>


                <div class="form-group row secestado">
                    <label class="col-sm-3 col-form-label" for="form-label">Estado: </label>
                    <div class="col-sm-9">
                        <select name="cbmoney" id="cbstate" class="form-control js-example-basic-single" style="width: 100%;">  
                        <option value="1">Activo</option>                        
                        <option value="0">Inactivo</option>                        
                        </select>
                    </div>
                </div>                           

              </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger"  data-dismiss="modal"><font style="vertical-align: inherit;">Cerrar Ventana</font></button>
                <button type="button"  class="btn btn-outline-success btnsave"  onclick="saveObjData()"><font style="vertical-align: inherit;">Guardar Usuario</font></button>
              </div>


            </div>
         </div>
    </div>
</form>


<script>
$(document).ready(function() {
    
    listWorker();

    //inicializamos el combo
    $(".js-example-basic-single").select2();
    //focus en input usuario
    $("#modal_editupdate").on('shown.bs.modal',function(){
        $("#namec").focus();  
    })




});

function hideshow(){
    var password = document.getElementById("pass1");
    var slash = document.getElementById("slash");
    var eye = document.getElementById("eye");
    
    if(password.type === 'password'){
        password.type = "text";
        slash.style.display = "block";
        eye.style.display = "none";
    }
    else{
        password.type = "password";
        slash.style.display = "none";
        eye.style.display = "block";
    }

}

</script>

        
         