<!-- Cargamos js que corresponde a vista de articulos -->
<div style="margin-top: 40px;"></div>
<script src="assets/js/customer.js"></script>
<div class="col-md-12 col-sm-12 ">
    <div class="dashboard_graph">
       
    <!-- Title secction -->
    <div class="row x_title">
        <div class="col-md-6">
          <h3>Mantenimiento de Clientes </h3>
        </div>
        <div class="col-md-6">
          <h2>LISTA DE CLIENTES</h2>
        </div>
    </div>
          <!-- /.box-tools -->
        
        <!-- /.box-header -->
        
          <div class="form-group">
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingrese el nombre del cliente">
                    <span class="btn btn-outline-info "><i class="fa fa-search"></i> Buscar</span>
                </div>            
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" style="width: 100%" onclick="AbrirModal()"> <i class="glyphicon glyphicon-plus"></i>Nuevo Cliente</button>
            </div>              
          </div>
                          
                <div class="panel-body">
                    <table id="table_listdata" class="table table-bordered dt-responsive nowrap table-td-valign-middle" style="width:100%">

                    <thead class="bg-info text-white">
                        <tr>
                            <th>Nombre Cliente</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>N° De Documento </th>
                            <th>Dirección</th>
                            <th>Estado Actual</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                    <tfoot class="bg-info text-white">
                        <tr>
                            <th>Nombre Cliente</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>N° De Documento </th>
                            <th>Dirección</th>
                            <th>Estado Actual</th>
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
                <h3 class="modal-title text-white"><b>Formulario de Cliente</b></h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
              </div>

              <div class="modal-body">
                <input type="hidden" value="0" id="idc">          

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Nombres: <span class="required text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control is-valid" id="namec" placeholder="Ingrese el nombre"  minlength="5" maxlength="50" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">N° Documento: <span class="required text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" min="0"  maxlength="15" class="form-control is-valid" id="docc" placeholder="Ingrese Número de documento" required onkeyup="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Teléfono: </label>
                    <div class="col-sm-9">
                        <input type="number" min="0"  maxlength="15" class="form-control" id="phonec" placeholder="Ingrese Número de teléfono" required onkeyup="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Correo: </label>
                    <div class="col-sm-9">
                        <input type="text" id="emailc"class="form-control"  placeholder="Ingrese el correo"> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Dirección: </label>
                    <div class="col-sm-9">
                        <input type="text" id="addressc" class="form-control"  placeholder="Ingrese la dirección"> 
                    </div>
                </div>

                <div class="form-group row secestado">
                    <label class="col-sm-3 col-form-label" for="form-label">Estado: </label>
                    <div class="col-sm-9">
                        <select name="cbstate" id="cbstate" class="form-control js-example-basic-single is-valid" style="width: 100%;">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                </div>
                                

              </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger"  data-dismiss="modal">
                    <font style="vertical-align: inherit;">Cerrar Ventana</font>
                </button>
                <button type="button"  class="btn btn-outline-success btnsave"  onclick="saveObjData()">
                    <font style="vertical-align: inherit;">Guardar Cliente</font></font>
                </button>
              </div>
            </div>
         </div>
    </div>
</form>


<script>
$(document).ready(function() {
    
    listCustomer();

    //inicializamos el combo
    $(".js-example-basic-single").select2();
    //focus en input usuario
    $("#modal_editupdate").on('shown.bs.modal',function(){
        $("#namec").focus();  
    })

});

</script>