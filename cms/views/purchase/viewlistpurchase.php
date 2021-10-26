<script src="views/purchase/vuelistpurchase.js"></script>

<div style="margin-top: 50px;"></div>
<div class="col-md-12 col-sm-12" id="app">
    <div class="dashboard_graph">

         <!-- Title secction -->
        <div class="row x_title">
            <div class="col-md-6">
              <h3>COMPRAS</h3>
            </div>
            <div class="col-md-6">
              <h2>Lista de compras</h2>
            </div>
        </div>

        <!-- /.box-header -->

        <div class="form-group">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" v-model="inpsearch" @keyup.enter="searchpurchase" class="form-control border border-info" placeholder="Ingrese nombre del proveedor o número de comprobante" autocomplete="off">
                </div>            
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="bg bg-outline-success input-group-addon">Desde</span>
                    <input v-model="finicio" class="form-control " type="date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="bg bg-outline-success input-group-addon">Hasta</span> 
                    <input v-model="ffin" class="form-control" type="date">
                </div>
            </div>
            <div class="col-md-1">
                <div class="input-group">
                    <button class="btn btn-outline-primary" @click="searchpurchase">
                        <i class="glyphicon glyphicon-search"></i>
                        Buscar
                    </button>
                </div>
            </div>

                         
        </div>


        <div class="panel-body">
            <table id="table_listdata" class="table table-bordered table-responsive-md" style="width:100%">

                <thead class="bg-info text-white">
                    <tr> 
                        <th>items</th>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Nombre de proveedor </th>
                        <th>Teléfono de proveedor</th>
                        <th>Nombre de Cajero</th>                        
                        <th>Monto de la compra</th>
                        <th>Opciones</th>                        
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="(s, index) in compras">
                        <th>{{s.id}}</th>
                        <th>{{s.documento}}</th>
                        <th>{{s.fecha}}</th>
                        <th>{{s.proveedor}}</th>
                        <th>{{s.phone}}</th>
                        <th>{{s.cajero}}</th>
                        <th>{{s.monto}}</th>
                        <th><button class="btn btn-primary"  @click="verdetalle(s.id)"> <i class="glyphicon glyphicon-search"></i></button></th>
                    </tr>

                 
                </tbody>
                <tfoot class="bg-info text-white">
                    <tr>
                        <th>items</th>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Nombre de proveedor </th>
                        <th>Teléfono de proveedor</th>
                        <th>Nombre de Cajero</th>                        
                        <th>Monto de la compra</th>
                        <th>Opciones</th> 
                    </tr>
                </tfoot>
            </table>
        </div>
        
    </div>


<!-- modal for inser and update -->

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade"   id="modaleditupdate" role="dialog"> 
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
              
              <div class="modal-header bg-info">  
                <h3 class="modal-title text-white"><b>DETALLE DE COMPRAS</b></h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
              </div>

              <div class="modal-body">
                <input type="hidden" value="0" id="idc">          
                <input type="hidden" value="0" id="userid">          

                <table id="tabledetail" class="table table-striped table-bordered table-responsive-md" style="width:100%">

                        <thead >
                            <tr>
                                <th>items</th>
                                <th>Nombre Producto</th>
                                <th>Precio </th>                            
                                <th>Cantidad</th>                                
                                <th>Subtotal</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, index) in detallecompra">
                                <th>{{index+1}}</th>
                                <th>{{d.name}}</th>
                                <th>{{d.price}}</th>                            
                                <th>{{d.quantity}}</th>
                                <th>{{rounddecimal(d.price*d.quantity)}}</th>
                                <th><button class="btn btn-danger btn-xs">X</button></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>TOTALES:</th>                            
                                <th>{{totalitems}}</th>                                
                                <th>{{subtotal}}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table> 
                                

              </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger"  data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cerrar Ventana</font></font></button>
                <!-- <button type="button"  class="btn btn-outline-success btnsave"  onclick="saveObjData()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Guardar Usuario</font></font></button> -->
              </div>


            </div>
         </div>
    </div>
</form>

</div> <!-- en d app -->


