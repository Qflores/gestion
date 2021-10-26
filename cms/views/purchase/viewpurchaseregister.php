
<div style="margin-top: 50px;"></div>

<div class="col-md-12 col-sm-12" id="app">
	<div class="dashboard_graph">
       
    <!-- Title secction -->
	    <div class="row x_title">
	        <div class="col-md-6">
	          <h3>COMPRAS</h3>
	        </div>
	        <div class="col-md-6">
	          <h2>Cabecera del Comprobante</h2>
	        </div>
	    </div>

	    <!-- /.box-header -->
	        
		<div class="form-group col-md-12 col-lg-12 headerpurchase">
             <div class="col-md-4">                 
                <div class="col-md-12">
                    <label class="col-md-3" for="">Código Producto:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9">
                        <input type="number"  v-model="codigonuevop" @keyup.enter="buscarproducto" class="form-control is-valid" placeholder="Código del producto">
                    </div> 
                </div>  
                <div class="col-md-12">
                    <label class="col-md-3">Nombre:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9 search-input">
                        <input type="text" class="form-control is-valid" v-model="nombrenuevop" v-on:keyup="searchByname" placeholder="Nombre del producto">
                        <div class="autocom-box cold-md-9">
                            <li class="fill-list" v-for="(art, index) in articles"  @click="addprodselect(index)"> {{art.name}} <span class="bg-primary text-al">{{art.price}}</span> </li>                                
                            
                        </div> 
                    </div> 
                </div>                
                <div class="col-md-12">
                    <label class="col-md-3" for="">Cantidad:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9">
                        <input type="number" v-model="cantidadnuevop" class="form-control is-valid" placeholder="Cantidad total del producto">
                    </div> 
                </div>
                <div class="col-md-12">
                    <label class="col-md-3" for="">Subtotal:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9">
                        <input type="number" v-model="precionuevop" @keyup.enter="addProduct" class="form-control is-valid" placeholder="Precio total del producto">
                    </div> 
                </div> 
                <div class="col-md-12 ">                                       
                    <div class="input-group col-md-12 justify-content-end">                        
                        <button class="btn btn-outline-info" @click="addProduct" title="Agregar Producto"> <i class="glyphicon glyphicon-shopping-cart"></i> </button>
                        
                    </div>
                </div>             
            </div> 
			<div class="col-md-4">
                <div class="col-md-12">
    			    <label class="col-md-3" for="">Comprobante:</label>
                    <div class="input-group col-md-8">
    			        <select  class="form-control" v-model="idvoucher" >
                            <option  v-for="(v, index) in voucher"  v-bind:value="v.id">{{v.name}}</option>                       
                        </select>
    			    </div> 
                </div>
                <div class="col-md-12">
                    <label class="col-md-3" for="">Serie:</label>
                    <div class="input-group col-md-8">
                        <input type="text" id="sfac" placeholder="Ingrese la Serie" class="form-control">
                    </div> 
                </div> 
                <div class="col-md-12">
                    <label class="col-md-3" for="">Número:</label>
                    <div class="input-group col-md-8">
                        <input type="text" id="numfac" placeholder="Número fac." class="form-control">
                    </div> 
                </div>           
			</div>
			<div class="col-md-4">
                <input type="hidden" id="idbp" v-model="businessid">              
                <div class="col-md-12">
                    <label class="col-md-3" for="">Razon Social:</label>
                    <div class="input-group col-md-8 search-input">
                        <input type="text" id="namebp" class="form-control" placeholder="Buscar por nombre/RUC" v-model="businessname" v-on:keyup="buscarproveedor" >
                        <div class="autocom-box cold-md-9">
                            <li class="fill-list" v-for="(s, index) in supplier"  @click="selecsupplier(index)"> {{s.name}} <span class="bg-primary text-al">{{s.ruc}}</span> </li>
                        </div>
                    </div> 
                </div>  
                <div class="col-md-12">
                    <label class="col-md-3" for="">RUC:</label>
                    <div class="input-group col-md-8">
                        <input type="number" id="rucbp" placeholder="Número de RUC" class="form-control" v-model="businessdoc">
                    </div> 
                </div> 	
                <div class="col-md-12">
                    <div class="input-group col-md-11 justify-content-end">
                        <label class="text-danger">{{notfount}}  </label>
                        <button class="btn btn-outline-primary" title="Registrar Proveedor Nuevo" @click="saveproveedor"> 
                            <i class="glyphicon glyphicon-floppy-save"></i>
                        </button>
                    </div> 
                </div> 		    
			</div>
                                  
		</div>

		<div class="col-md-12">
			<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
	            <li class="nav-item">
	              <a class="nav-link active" id="pticke1" data-toggle="tab" href="#ticke1" role="tab" aria-controls="home" aria-selected="true">Ticket Compras</a>
	            </li>	            
	        </ul>

		    <div class="tab-content" id="myTabContent">
		        <div class="tab-pane fade active show" id="ticke1" role="tabpanel" aria-labelledby="pticke1">
        		    <table id="table_listdata" class="table table-bordered  table-bordered table-responsive-sm" style="width:100%">
        				<thead class="bg-info text-white">
                            <tr>
                                <th>Items</th>
                                <th>Nombre producto</th>
                                <th>Cantidad</th>                       
                                <th>Precio Unitario</th>
                                <th>Valor Total</th>
                                <th>Bonificación</th>
                                <th>Impuesto</th>                        
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr v-if="productos != null" v-for="(pro, index)  in productos">
                                <th>{{pro.sku}}</th>
                                <th>{{pro.nombre}}</th>
                                <th> <input type="number" min="0.00" @change="sumarprecio" v-on:keyup="sumarprecio" v-model.number="pro.cantidad"></th>
                                <th> <input type="number" min="0.00" @change="sumarprecio" v-on:keyup="sumarprecio" v-model.number="pro.punitario"></th>
                                <th>{{ twodecimal(pro.cantidad*pro.punitario) }}</th>
                                <th><input type="checkbox" v-model="pro.bonificacion" @click="calbonificacion(index)"></th>
                                <th>{{pro.impuesto>0? 'si':'no'}}</th>
                                <th> <button style='font-size:13px;' class='btn btn-danger' @click="eliminarproducto(index)"><i class='fa fa-trash'></i>&nbsp;Eliminar</button></th>
                            </tr> 
                            <tr v-else><th colspan="5"> <h3>Agrega productos comprados</h3> <th></tr>            
                        </tbody>
                        <tfoot class="bg-info text-white">
                            <tr>
                                <th>Items</th>
                                <th>Nombre producto</th>
                                <th>Cantidad</th>                       
                                <th>Precio Unitario</th>
                                <th>Valor Total</th>
                                <th>Bonificación</th>
                                <th>Impuesto</th>                        
                                <th>Opciones</th>
                            </tr>
                        </tfoot>               

        			</table>
                    <div class="col-md-4">
                        <div class="product_price">
                            <div>
                                <h5 class="price"><b>RESUMEN COMPRA</b></h5>
                            </div>
                            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                <div class="col">MONTO TOTAL: </div>
                                <div class="col text-right"><b style="font-size: 18px;"> S/. {{montototal}}</b></div>
                            </div>
                            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                <div class="col" >CANTIDAD TOTAL:</div>
                                <div class="col text-right"><b style="font-size: 18px;">{{cantidadtotal}}</b></div>
                            </div>                     
                            <button class="btn btn-primary" @click="savepurshase"><span class="glyphicon glyphicon-floppy-save"></span> GUARDAR COMPRA</button>
                        </div>
                    </div>
		        </div>
		  </div>
		</div> <!-- `tamb end -->
           
		<div class="panel-body">
			
		</div>


	</div>
	<!-- end dashboard -->
</div>
<!-- end app -->
 <!-- VUE JS -->

<script src="views/purchase/vuejspurchase.js">
	
</script>

<style type="text/css">
    .headerpurchase label{
        text-align: right;
    }

    .table tbody th{
        padding: 3px 2px 0px 10px !important;
    }

    /*Autocomplete box*/
    /*search-input = container*/
    /*autocom-box  = ul*/
    /*fill-list = li*/
    /*.headerpurchase input{
        margin: 0px ;
    }*/
    .headerpurchase .input-group {
        margin-bottom: 1px; 
    }

    .search-input input{        
        box-shadow: 0px 1px 5px  rgba(0,0,0,0.1);
    }
    .search-input  .autocom-box{
        margin-top: 39px;
        display: grid;
        position: absolute !important;
        z-index: 2;
        width: 100%;
        background: #ffff;
        box-shadow: 0px 2px 5px  rgb(0 0 0 / 100%);
    }

    .autocom-box li{
        text-decoration: none !important;
        list-style:none;
        margin-left: 5px;
        padding: 1px;
        overflow: hidden;
        height: 25px;
        position: initial;
        display: flex;
        border-bottom: solid 1px;
        color: #444;
    }
    .autocom-box li:hover{
        cursor: pointer;
        background: #17A2B8FF;
        color: #FFF;
    }

    .autocom-box span{
        background-color: #06bda0d4!important;
        position: static;
        padding: 2px;
        border-radius: 5%;
        margin: inherit;
        color: #ffff;
    }

     /** botones por defecto de input number disabled */
    /* Chrome, Safari, Edge, Opera */
       .headerpurchase input::-webkit-inner-spin-button, 
       .headerpurchase input::-webkit-outer-spin-button{
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
       .headerpurchase input[type=number] {
          -moz-appearance: textfield;
        }

</style>
