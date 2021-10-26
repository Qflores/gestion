

<div style="margin-top: 50px;"></div>
<div class="col-md-12 col-sm-12" id="app">
	<div class="dashboard_graph">

		 <!-- Title secction -->
	    <div class="row x_title">
	        <div class="col-md-6">
	          <h3>VENTAS</h3>
	        </div>
	        <div class="col-md-6">
	          <h2>Lista de ventas</h2>
	        </div>
	    </div>

	    <!-- /.box-header -->

	    <div class="form-group">
            <div class="col-md-3">
                <div class="input-group">
                    <input v-model="searchname" type="text" class="global_filter form-control" id="global_filter" @keyup.enter="searchbyFilter" placeholder="Nombre: cliente o vendedor">
                </div>            
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="bg bg-outline-success input-group-addon">Desde</span>
                    <input v-model="fstart" class="form-control " type="date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="bg bg-outline-success input-group-addon">Hasta</span> 
                    <input v-model="fend" class="form-control" type="date">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <!-- <span class="bg bg-outline-success input-group-addon">Hasta</span>  -->
                    <select class="form-control" v-model="hstate">
                        <option v-bind:value="1">Seleccione Una Opcion</option>
                        <option v-bind:value="1">Ventas Emitidos</option>
                        <option v-bind:value="2">Ventas Pendiente</option>
                        <option v-bind:value="3">Cuentas Abonados</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-outline-primary" style="width: 100%" @click="searchbyFilter"> <i class="glyphicon glyphicon-search"></i> Buscar</button>
            </div>              
        </div>


        <div class="panel-body">
            <table id="table_listdata" class="table table-bordered  table-responsive-md" style="width:100%">

                <thead class="bg-info text-white">
                    <tr>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Nombre Cliente </th>
                        <th>Documento de Cliente </th>
                        <th>Email de Cliente</th>
                        <th>Nombre Vendedor </th>
                        <th>Estado</th>
                        <th>Opciones</th>                        
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="(s, index) in sales">                        
                        <th>{{s.code}}</th>
                        <th>{{s.fecha}}</th>
                        <th>{{s.customer}}</th>
                        <th>{{s.document}}</th>
                        <th>{{s.email}}</th>
                        <th>{{s.users}}</th>
                        <th v-if="s.state==1" class="alert alert-success">Emitido</th>
                        <th v-if="s.state==2" class="alert alert-warning">Pendiente</th>
                        <th v-if="s.state==3" class="alert alert-info">Abonado</th>
                        <th style="display: flex;">
                            <button class="btn btn-info bt-sm"  @click="printsales(s.id)" title="Imprimir" > <i class="glyphicon glyphicon-print"></i></button>
                            <button v-if="s.state>0" class="btn btn-primary bt-sm"  @click="vervetalle(s.id)" title="Ver Detalle" > <i class="glyphicon glyphicon-search"></i></button>
                            <button v-if="s.state==2"  class="btn btn-danger bt-sm"  @click="payacount(s.id)" title="Pagar Cuenta" > <i class="glyphicon glyphicon-credit-card"></i></button>
                        </th>
                    </tr>

                 
                </tbody>
                <tfoot class="bg-info text-white">
                    <tr>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Nombre Cliente </th>
                        <th>Documento de Cliente </th>
                        <th>Email de Cliente</th>
                        <th>Nombre Vendedor </th>
                        <th>Monto de la factura</th>
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
                <h3 class="modal-title text-white"><b>Detalle de la factura:</b></h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
              </div>

              <div class="modal-body">
                <input type="hidden" value="0" id="idc">          
                <input type="hidden" value="0" id="userid">          

                <table id="tabledetail" class="table table-striped table-bordered table-responsive-md  table-td-valign-middle" style="width:100%">

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
                            <tr v-for="(d, index) in salesdetail">
                                <th>{{index+1}}</th>
                                <th>{{d.name}}</th>
                                <th>{{d.price}}</th>                            
                                <th>{{d.canty}}</th>                                
                                <th>{{rounddecimal(d.price*d.canty)}}</th>
                                <th><button class="btn btn-danger btn-xs">X</button></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>SUBTOTAL:</th>                            
                                <th>{{totalitems}}</th>                                
                                <th>{{subtotal}}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table> 
              </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger"  data-dismiss="modal"><font style="vertical-align: inherit;">Cerrar</font></button>                
              </div>


            </div>
         </div>
    </div>
</form>

</div> <!-- en d app -->


<script src="views/sales/vuelistsales.js"></script>

<style>
    table.dataTable tbody td, table.dataTable tbody th{        
        padding-top: 0.5px !important;
        padding-bottom: 0px !important;
        /*vertical-align: initial;*/
    }

    .table td, .table th {
        vertical-align: center !important;
    }
</style>