<!-- Cargamos js que corresponde a vista de articulos -->

<script src="assets/js/supplier.js"></script>
<div class="col-md-12 col-sm-12 ">
    <div class="dashboard_graph">
       
    <!-- Title secction -->
    <div class="row x_title">
        <div class="col-md-6">
          <h3>Mantenimiento de Proveedores </h3>
        </div>
        <div class="col-md-6">
          <h2>LISTA DE PROVEEDORES</h2>
        </div>
    </div>
          <!-- /.box-tools -->
        
        <!-- /.box-header -->
        
          <div class="form-group">
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingrese el ruc ó razon social del proveedor">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>            
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" style="width: 100%" onclick="AbrirModal()"> <i class="glyphicon glyphicon-plus"></i>Nuevo Proveedor</button>
            </div>              
          </div>
                          
                <div class="panel-body">
                    <table id="table_listdata" class="table table-bordered dt-responsive nowrap table-td-valign-middle" style="width:100%">

                    <thead class="bg-info text-white">
                        <tr >
                            <th>Nombre Compañía</th>
                            <th>Dirección</th>
                            <th>Tipo Documento</th>
                            <th>Número de documento</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Serie Factura</th>
                            <th>Tipo de Moneda</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                    <tfoot class="bg-info text-white">
                        <tr>
                            <th>Nombre Compañía</th>
                            <th>Dirección</th>
                            <th>Tipo Documento</th>
                            <th>Número de documento</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Serie Factura</th>
                            <th>Tipo de Moneda</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    </table>
            </div>
        </div>
</div>


<!-- modal for inser and update -->
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade " id="modal_editupdate" role="document"> 
        <div class="modal-dialog modal-lg modal-dialog-top ">
            <div class="modal-content">
              
              <div class="modal-header bg-info">  
                <h3 class="modal-title text-white"><b>Formulario de Proveedor</b></h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
              </div>

              <div class="modal-body">
                <input type="hidden" value="0" id="newsupplier">
                <div class="form-group row" >
                    <label class="col-sm-3 col-form-label" for="form-label">Razon Social: <span class="required text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control is-valid" id="namep" placeholder="Ingrese nombre razon social" maxlength="80" minlength="1" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">N° Documento: <span class="required text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" id="nump" min="0" maxlength="20" class="form-control is-valid"  placeholder="Ingrese número de documento">
                    </div>                        
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Tipo de Documento: </label>
                    <div class="col-sm-9">
                        <select name="cbtipodoc" id="cbtipodoc" class="form-control js-example-basic-single is-valid" style="width: 100%;">
                            <option value="1">Cédula</option>
                            <option value="2">RUC</option>
                            <option value="3">Pasaporte</option>
                            <option value="4">Otros</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Dirección: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="addressp" placeholder="Ingrese la Direccion"  minlength="3" maxlength="100" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Teléfono: </label>
                    <div class="col-sm-9">
                        <input type="number" id="phonep" min="0" maxlength="15" class="form-control"  placeholder="Ingrese el número de teléfono"> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Correo: </label>
                    <div class="col-sm-9">
                         <input type="text" id="emailp" min="0" maxlength="55" class="form-control"  placeholder="Ingrese el correo">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Serie de Facturación: </label>
                    <div class="col-sm-9">
                        <input type="text" id="serp" min="0" maxlength="20" class="form-control"  placeholder="Ingrese la serie">  
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="form-label">Moneda: </label>
                    <div class="col-sm-9">
                        <select name="cbmoney" id="cbmoney" class="form-control js-example-basic-single" style="width: 100%;">                          
                        </select>
                    </div>
                </div>     

            </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger"  data-dismiss="modal">
                    <font style="vertical-align: inherit;">Cerrar Ventana</font>
                </button>
                <button type="button" class="btn btn-outline-success btnsave"  onclick="saveObjData()">
                    <font style="vertical-align: inherit;">Guardar Proveedor</font>
                </button>
              </div>

            </div>
         </div>
    </div>
</form>


<script>
$(document).ready(function() {    
    listSupplier();
    //inicializamos el combo
    $(".js-example-basic-single").select2();
    //focus en input usuario
    $("#modal_consulta").on('shown.bs.modal',function(){
        $("#nombrem").focus();  
    })

});

</script>