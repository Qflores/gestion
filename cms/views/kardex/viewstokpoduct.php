


<div class="col-md-12 col-sm-12" id="app">		
        <div class="page-title">
          <div class="title_left">
            <h3>KARDEX</h3>
          </div>          
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="col-md-5 top_search">
                    <div class="input-group">
                        <input type="text" class="form-control border border-info" v-model="skuprod" @keyup.enter="filterprodbyid" placeholder="Ingrese el código o nombre del artículo" autocomplete="off">                   
                    </div>            
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="bg bg-info text-white input-group-addon">Fecha</span>
                        <input v-model="finicio" class="form-control  border border-info" type="date">
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary" style="width: 100%" @click="filterprodbyid"> 
                        <i class="glyphicon glyphicon-search"></i> Buscar
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel" style="">
                    <div class="x_title">
                        <h2>INFORMACIÓN DEL PRODUCTO <small> DETALLES</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link" @click="hidensection(1)" ><i :class="['fa ', editactive? 'fa-chevron-up':'fa-chevron-down']"></i></a>
                            </li>                            
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" :class="[editactive ? 'd-block':'d-none']">

                        <div class="container">
                            <div class="row" v-for="(a, index) in articleinfo">
                                <div class='col-md-4'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                               <span class="glyphicon text-white">NOMBRE</span>
                                            </span>
                                            <label type='text' class="form-control" style="overflow: auto;"> {{a.name}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                               <span class="glyphicon text-white">DETALLE</span>
                                            </span>
                                            <label type='text' class="form-control" style="overflow: auto;"> {{a.detail}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                               <span class="glyphicon text-white">PRECIO VENTA</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.price}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                               <span class="glyphicon text-white">PRECIO COMPRA</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.pricebuy}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">TAMAÑO/PESO</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.size}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                               <span class="glyphicon text-white">UNIDAD</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.unidad}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">CATEGORÍA</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.categoria}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">ISC</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.isc}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">IGV</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.iva*100}}%</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">MARCA</span>
                                            </span>
                                            <label type='text' class="form-control"> {{a.marca}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">STOCK MIN</span>
                                            </span>
                                            <label type='text' class="form-control">{{a.min}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">STOCK MAX</span>
                                            </span>
                                            <label type='text' class="form-control">{{a.max}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">EMPRESA</span>
                                            </span>
                                            <label type='text' class="form-control" style="overflow: auto;">{{a.empresa}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <span class="input-group-addon bg-info">
                                                <span class="glyphicon text-white">SUCURSAL</span>
                                            </span>
                                            <label type='text' class="form-control" style="overflow: auto;">{{a.office}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>

            <div class="col-md-12">
                <div class="x_panel" style="">
                    <div class="x_title">
                        <h2>MOVIMIENTOS DEL PRODUCTO<small> DEL MES SELECCIONADO</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link" @click="hidensection(2)"><i :class="['fa ', editactive2? 'fa-chevron-up':'fa-chevron-down']"></i></a>
                            </li>                            
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- table-responsive dt-responsive-->
                    <div class="x_content" :class="[editactive2 ? 'd-block':'d-none']">
                        <table id="tablelistdata" class="table table-bordered table-responsive nowrap table-td-valign-middle" style="width:100%">
                            <thead class="bg-info text-white" style="text-align: center;">
                                <tr>
                                    <th Colspan="4" rowspan="2">DOCUMENTO INTERNO</th> 

                                    <th rowspan="3">TIPO OPERACIÓN</th>

                                    <th Colspan="3">ENTRADAS </th>
                                    <th Colspan="3">SALIDAS </th>
                                    <th Colspan="3">SALDO FINAL</th>                            

                                </tr>
                                    
                                    <tr>
                                        <td rowspan="2">CANTIDAD</td>
                                        <td rowspan="2">COSTO UNITARIO</td>
                                        <td rowspan="2">COSTO TOTAL</td>

                                        <td rowspan="2">CANTIDAD</td>
                                        <td rowspan="2">COSTO UNITARIO</td>
                                        <td rowspan="2">COSTO TOTAL</td>

                                        <td rowspan="2">CANTIDAD</td>
                                        <td rowspan="2">COSTO UNITARIO</td>
                                        <td rowspan="2">COSTO TOTAL</td>

                                        <!-- <td rowspan="2" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(180deg);">CANTIDAD</td> -->
                                    </tr>
                                    <tr>
                                        <td>FECHA</td>
                                        <td>TIPO DOC</td>
                                        <td>SERIE</td>
                                        <td>NÚMERO</td>
                                    </tr>
                            </thead>
                            <tbody >
                                <!-- <tr v-for="(p, index) in productos">                        
                                    <th>{{p.fecha}}</th>
                                    <th>{{p.num_fac}}</th>
                                    <th>{{p.voucher}}</th>
                                    <th>{{p.id_product}}</th>
                                    <th>{{p.operacion}}</th>
                                    <th>{{p.buy_canty}}</th>
                                    <th>{{p.buy_unit}}</th>
                                    <th>{{p.buy_total}}</th>
                                    <th>{{p.sales_canty}}</th>
                                    <th>{{p.sales_unit}}</th>
                                    <th>{{p.sales_total}}</th>
                                    <th>{{p.prom_canty}}</th>
                                    <th>{{p.prom_unit}}</th>
                                    <th>{{p.prom_total}}</th>
                                    
                                </tr> -->

                             
                            </tbody>
                            <tfoot class="">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>SUMA TOTAL</th>
                                    <th></th>
                                    <th></th>
                                </tr>                                
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>	
</div>


<script src="views/kardex/searchkardexbysku.js"> </script>

<script type="text/javascript">
    $(document).ready(function () {
        
        $('#tablelistdata').DataTable();

    })
</script>