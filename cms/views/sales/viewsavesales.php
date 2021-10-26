
<div style="margin-top: 50px;"></div>

<div class="col-md-12 col-sm-12" id="app">
	<div class="dashboard_graph">
       
    <!-- Title secction -->
	    <div class="row x_title">
	        <div class="col-md-2">
	          <h3>VENTAS </h3>
              <span> </span>
	        </div>
	        <div class="col-md-10">
                 <img v-bind:src="'assets/images/'+buslogo" width="50" alt="">
	          <span class="text-info">
                {{busname}}, Sucursal: {{bussuc}}, RUC: {{busruc}}
              </span>
	        </div>
	    </div>

	    <!-- /.box-header -->
	        
		<div class="form-group col-md-12 col-lg-12 headerpurchase">
             <div class="col-md-4">                 
                <div class="col-md-12">
                    <label class="col-md-3" for="">Código Producto:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9">
                        <input type="text"  v-model="codigonuevop" @keyup.enter="searchBySku" class="form-control is-valid" placeholder="Ingrese Codigo del producto" maxlength="35">
                    </div> 
                </div>  
                <div class="col-md-12">
                    <label class="col-md-3">Nombre:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9 search-input">
                        <input type="text" class="form-control is-valid" v-model="nombrenuevop" v-on:keyup="searchByname" placeholder="Ingrese nombre del producto">
                        <div class="autocom-box cold-md-9">
                            <li class="fill-list" v-for="(art, index) in articles"  @click="addprodselect(index)"> {{art.name}} <span class="bg-primary text-al">{{art.price}}</span> </li> 
                        </div>
                    </div> 
                </div>
                <div class="col-md-12">
                    <label class="col-md-3" for="">Cantidad:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9">
                        <input type="number" v-model="cantidadnuevop" class="form-control is-valid">
                    </div> 
                </div>
                <div class="col-md-12">
                    <label class="col-md-3" for="">Precio Unitario:<span class="required text-danger">*</span></label>
                    <div class="input-group col-md-9">
                        <input type="number" v-model="precionuevop" class="form-control is-valid">
                    </div> 
                </div>                 
                <div class="col-md-12 "> 
                    <label class="col-md-3" for="checkbox"> Con Impuesto:  </label>
                    <input class="form-control col-md-1 justify-content-end" type="checkbox"  v-model="impuestop" checked=""  style="font-size: 8px;">                    
                    <div class="input-group col-md-8 justify-content-end">
                        <button class="btn btn-outline-primary" @click="saveproduct" title="Registrar Producto nuevo"> <i class="glyphicon glyphicon-floppy-save"></i> </button>
                    </div> 
                </div>             
            </div> 
			<div class="col-md-4">
                <div class="col-md-12">
    			    <label class="col-md-3" for="">Comprobante:</label>
                    <div class="input-group col-md-8">
    			        <select  class="form-control" v-model="idvoucher">
                            <option  v-for="(v, index) in voucher"  v-bind:value="v.id">{{v.name}}</option>
                        </select>
    			    </div> 
                </div>
                <div class="col-md-12">
                    <label class="col-md-3" for="">Serie:</label>
                    <div class="input-group col-md-8">
                        <input type="text" value="F001" disabled="" class="form-control">
                    </div> 
                </div> 
                <div class="col-md-12">
                    <label class="col-md-3" for="">Número:</label>
                    <div class="input-group col-md-8">
                        <input type="number"  value="101010"  class="form-control" disabled="">
                    </div> 
                </div>  
                <div class="col-md-12">
                    <label class="col-md-3" for="">Metodo Pago:</label>
                    <div class="input-group col-md-8">
                        <select @change="selectustomer" v-model="paymethod" class="form-control">
                            <option  v-bind:value="1">Efectivo</option>
                            <option  v-bind:value="2">Crédito</option>
                        </select>
                    </div> 
                </div>         
			</div>
			<div class="col-md-4">  
                <input type="hidden" id="idbp" v-model="customerid">                   
                <div class="col-md-12">
                    <label class="col-md-3" for="">Nombres:</label>
                    <div class="input-group col-md-8 search-input">
                        <input type="text" class="form-control" v-model="customername" v-on:keyup="buscarcustomer" :placeholder="defaulname=='' ? 'Seleccione un cliente': [[defaulname]]">
                        <div class="autocom-box cold-md-9">
                            <li class="fill-list" v-for="(s, index) in customer"  @click="seleccustomer(index)"> {{s.name}} <span class="bg-primary text-al">{{s.ruc}}</span> </li>
                        </div>
                    </div> 
                </div>  
                <div class="col-md-12">
                    <label class="col-md-3" for="">Cédula/RUC:</label>
                    <div class="input-group col-md-8">
                        <input type="number" class="form-control"  v-model="customerdoc" :placeholder="[[defauldoc]]" >
                    </div> 
                </div> 
                <div class="col-md-12">                    
                    <div class="input-group col-md-11 justify-content-end">
                        <label class="text-danger">{{notfount}}</label>
                        <button class="btn btn-outline-primary" title="Regitrar Proveedor Nuevo" @click="savecustomer"> <i class="glyphicon glyphicon-plus"></i></button>
                    </div> 
                </div>			    
			</div>                                  
		</div>
        <div class="col-md-12">
            <button class="btn btn-outline-warning" title="Borrar Toda las compras" @click="deleteall(1)"> <i class="glyphicon glyphicon-trash"></i>
                Borrar Seleccionado
            </button>
            <button class="btn btn-outline-danger" title="Borrar Toda las compras" @click="deleteall(-1)"> <i class="glyphicon glyphicon-trash"></i>
                Borrar Todo
            </button>
        </div>

        <!-- Detalle de la compra aria-controls="contact" -->

		<div class="col-md-12">
			<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
	            <li class="nav-item" v-for="(t, index) in listtabs">
	              <a class="nav-link" id="pticke1" data-toggle="tab" v-bind:href="'#'+t.titulo+t.id" @click="addtab(index)"  role="tab">{{t.titulo+t.id}}</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link border border-light text-primary" data-toggle="tab" @click="addtab(-1)" role="tab" >Nuevo <i class="glyphicon glyphicon-plus"></i></a>
	            </li>
	        </ul>

		    <div class="tab-content" id="myTabContent">
		        <div class="tab-pane fade show" v-for="(t, index) in listtabs" v-bind:id="t.titulo+t.id" role="tabpanel" aria-labelledby="pticke+t.id">
        		    <table id="table_listdata" class="table table-bordered  table-bordered table-responsive-sm" style="width:100%">
        				<thead class="bg-info text-white">
                            <tr>
                                <th>Items</th>
                                <th>Nombre producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>  
                                <th>Descuento</th>                       
                                <th>Bonificación</th>                     
                                <th>Valor Total</th>                     
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr v-if="productos != null" v-for="(pro, index)  in productos">
                                <th>{{pro.sku}}</th>
                                <th>{{pro.nombre}}</th>
                                <th>
                                    <input type="number" min="0.00" @change="sumarprecio" v-on:keyup="sumarprecio" v-model.number="pro.punitario">
                                </th>
                                <th>
                                    <!-- <button  class="btn btn-danger btn-sm" @change="sumarprecio" name="" @click="pro.cantidad = pro.cantidad-1">+</button> -->
                                    <input type="number" min="0.00" @change="sumarprecio" v-on:keyup="sumarprecio" v-model.number="pro.cantidad">
                                    <!-- <button  class="btn btn-success btn-sm" @change="sumarprecio" name="" @click="pro.cantidad = pro.cantidad+1">+</button> -->
                                </th>
                                <th>
                                    <input type="number" min="0.00" @change="sumarprecio" v-on:keyup="sumarprecio" v-model.number="pro.descuento">
                                </th>
                                <th>
                                    <div class="form-check form-switch" >
                                    </div>
                                </th>
                                <th v-model.number="pro.precio=pro.cantidad*pro.punitario-pro.descuento">{{roundPriceArt(pro.precio)}}</th>
                                
                                <th> <button style='font-size:13px;' title="Eliminar Artículo"  class='btn btn-danger' @click="eliminarproducto(index)"><i class='fa fa-trash'></i>&nbsp;</button></th>
                            </tr>                                
                        </tbody>
                        <tfoot class="bg-info text-white">
                            <tr>
                                <th>Items</th>
                                <th>Nombre producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>                       
                                <th>Descuento</th>                       
                                <th>Bonificación</th>                       
                                <th>Valor Total</th>                      
                                <th>Opciones</th>
                            </tr>
                        </tfoot>               

        			</table>

           

                    <div class="col-md-4">
                        <div class="product_price">
                            <div>
                                <h5 class="price"><b>RESUMEN VENTA</b></h5>
                            </div>
                            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                <div class="col">SUBTOTAL: </div>
                                <div class="col text-right"><b style="font-size: 18px;"> {{moneda}} {{montototal}}</b></div>
                            </div> 
                            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                <div class="col" >CANTIDAD ITEMS:</div>
                                <div class="col text-right"><b style="font-size: 18px;">{{cantidadtotal}}</b></div>
                            </div>                    
                            <div class="row">
                                <div class="col"><button class="btn btn-primary justify-content-start" @click="savepurshase"><span class="glyphicon glyphicon-floppy-save"></span>REGISTRAR VENTA</button> </div>
                                <div class="col text-right">                        
                                    <label class="justify-content-end" for="checkbox" style="font-size: 18px;">Imprimir
                                    <input  class="form-control" type="checkbox" v-model="printsales">
                                </label> 
                                </div>
                            </div>
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

<script src="views/sales/vuejssales.js">
	
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

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #ffffff !important;
            background-color: #17a2b8 !important;
            border-color: #ffffff #ffffff #ffffff !important;
        }
   
</style>
