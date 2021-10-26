
<div class="" id="app">

    <div class="page-title" style="height: 37PX;">
        <div class="">
            <h5>
                MANTENIMIENTO DE 
                <small>
                    LISTA DE PRODUCTOS
                </small>
            </h5>
        </div>        
    </div>

     <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="form-group">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingrese el código o nombre del artículo" autocomplete="off">
                    <button onclick="filterArticleBynameLimit()" class="btn btn-outline-success">
                        <i class="fa fa-search"></i> Buscar
                    </button>
                </div>            
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-primary" style="width: 100%" onclick="AbrirModal()"> <i class="glyphicon glyphicon-plus"></i>Nuevo Artículo</button>
            </div>              
          </div>
                          
         <div class="panel-body">
            <table id="table_listdata" class="table table-bordered dt-responsive nowrap table-td-valign-middle" style="width:100%">

                    <thead class="bg-info text-white">
                        <tr>
                            <th>Código</th>
                            <th>Artículo</th>
                            <th>Precio </th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Medida</th>
                            <th>Marca</th>                            
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                    <tfoot class="bg-info text-white">
                        <tr>
                            <th>Código</th>
                            <th>Artículo</th>
                            <th>Precio </th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Medida</th>
                            <th>Marca</th>                            
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    </table>
            </div>
        </div>
         
     </div>

     <div class="row">
        <form onsubmit="return false" id="formproductos" autocomplete="off">
            <div class="modal fade " id="modal_editupdate" role="dialog"> 
                <div class="modal-dialog modal-lg modal-dialog-top ">
                    <div class="modal-content">
                      
                      <div class="modal-header bg-info">  
                        <h3 class="modal-title text-white"><b>Formulario de Artículo</b></h3>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                      </div>

                      <div class="modal-body">
                        <input type="hidden" value="0" id="newarticle">
                        <div class="form-group row secodigo" >
                            <label class="col-sm-3 col-form-label" for="form-label">Código: <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control is-valid" id="skua" placeholder="Ingrese el código" maxlength="40" minlength="1" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">Nombre: <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control is-valid" id="namea" placeholder="Ingrese el nombre"  minlength="3" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">Precio venta: <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" min="0.10" max="9999.00"  class="form-control is-valid" id="pricea" placeholder="Ingrese el precio de venta" required onkeyup="validateinput(this)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">Precio Compra:</label>
                            <div class="col-sm-9">
                                <input type="number" min="0.10" max="9999.00"  class="form-control" id="priceab" placeholder="Ingrese el precio de compra" required onkeyup="validateinput(this)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">Cantidad: <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" id="cantya" min="0.10" max="9999.00" class="form-control is-valid"  placeholder="Ingrese la cantidad">                   
                            </div>                        
                        </div> 

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">Impuesto:</label>
                            <div class="col-sm-9">
                                <label>
                                    <input type="checkbox" class="js-switch" id="impa" name="impa" value=""> Tiene Impuesto
                                </label>                 
                            </div>                        
                        </div> 

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">¿Maneja Stock?</label>
                            <div class="col-sm-9">
                                <label>
                                    <input type="checkbox" class="js-switch" id="stock" name="stock" value=""> Si Maneja Stock
                                </label>                 
                            </div>                        
                        </div> 


                        <div class="form-group row secisc">
                            <label class="col-sm-3 col-form-label" for="form-label">ISC %: </label>
                            <div class="col-sm-9">
                                <input type="number" id="isca" min="0" max="100" class="form-control" placeholder="ingrese Impuesto selectivo al consumo" >                   
                            </div>                        
                        </div>

                        <div class="form-group row secmin">
                            <label class="col-sm-3 col-form-label" for="form-label">Cantidad Mínima: </label>
                            <div class="col-sm-9">
                                <input type="number" id="mina" min="0.00" max="1.00" class="form-control" placeholder="Ingrese Cantidad mínima en stock" >                   
                            </div>                        
                        </div>
                        <div class="form-group row secmax">
                            <label class="col-sm-3 col-form-label" for="form-label">Cantidad Máxima: </label>
                            <div class="col-sm-9">
                                <input type="number" id="maxa" min="0.00" max="1.00" class="form-control" placeholder="Ingrese Cantidad máxima en stock" >                   
                            </div>                        
                        </div>

                        <div class="form-group row secpeso">
                            <label class="col-sm-3 col-form-label" for="form-label">Tamaño:</label>
                            <div class="col-sm-9">
                                <input type="number" id="sizea" min="0.100" max="999999.000" class="form-control"  placeholder="Ingrese el peso">                   
                            </div>                        
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">Unidad Medica:</label>
                            <div class="col-sm-9">
                                <div class="input-group d-display" id="secunidadlist">
                                    <select name="cbsize" id="cbsize" class="form-control js-example-basic-single custom-select" style="width: 90%;"></select>
                                    <div class="input-group-append" style="width: 10%;">
                                        <button title="Nueva Unidad Medida" onclick="newUnidad()" type="button" class="btn btn-outline-info glyphicon glyphicon-plus"></button>
                                    </div>
                                </div>
                                <div class="input-group d-none" id="secunidadadd">
                                    <input type="text" class="form-control is-valid" id="newunidad" placeholder="Ingrese Nombre de unidad">
                                    <input type="text" class="form-control is-valid" id="newsymbol" placeholder="Ingrese símbolo/abreviatura">
                                    <div class="input-group-append">
                                        <button title="Guardar Unidad de Medida" onclick="listUnidad(true)" type="button" class="btn btn-outline-success glyphicon glyphicon-floppy-save"></button>
                                        <button title="Cancelar" onclick="listUnidad(false)" type="button" class="btn btn-outline-danger glyphicon glyphicon-retweet"></button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="form-label">Categoría:</label>
                            <div class="col-sm-9 ">
                                <div class="input-group d-display" id="seccategorylist">
                                    <select name="cbcat" id="cbcat" class="form-control js-example-basic-single is-valid" style="width: 90%;"></select>
                                    <div class="input-group-append" style="width: 10%;">
                                        <button title="Nueva Categoría" type="button" onclick="newCategory()" class="btn btn-outline-info glyphicon glyphicon-plus"></button>
                                    </div>                            
                                </div>
                                <div class="input-group d-none" id="seccategoryadd">
                                    <input type="text" class="form-control is-valid" id="newcategory" placeholder="Ingrese Nombre de Categoría">
                                    <div class="input-group-append">
                                        <button title="Guardar Categoría" type="button" onclick="listCategory(true)" class="btn btn-outline-success glyphicon glyphicon-floppy-save"></button>
                                        <button title="Cancelar" type="button" onclick="listCategory(false)" class="btn btn-outline-danger glyphicon glyphicon-retweet"></button>
                                    </div>                            
                                </div>   
                            </div>
                        </div>

                        <div class="form-group row secmarca">
                            <label class="col-sm-3 col-form-label" for="form-label">Marca: </label>
                            <div class="col-sm-9">
                                <div class="input-group d-display" id="secmarcalist">
                                    <select name="cbmarca" id="cbmarca" class="form-control js-example-basic-single is-valid" style="width: 90%;"></select>
                                    <div class="input-group-append" style="width: 10%;">
                                        <button title="Nueva Marca" type="button" onclick="newMarca()" class="btn btn-outline-info glyphicon glyphicon-plus"></button>
                                    </div>
                                </div>
                                <div class="input-group d-none" id="secmarcaadd">
                                    <input type="text" class="form-control is-valid" id="newmarca" placeholder="Ingrese Nombre de Marca">
                                    <div class="input-group-append">
                                        <button title="Guardar Marca" type="button" onclick="listMarca(true)" class="btn btn-outline-success glyphicon glyphicon-floppy-save"></button>
                                        <button title="Cancelar" type="button" onclick="listMarca(false)" class="btn btn-outline-danger glyphicon glyphicon-retweet"></button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row secestado">
                            <label class="col-sm-3 col-form-label " for="form-label">Estado: </label>
                            <div class="col-sm-9">
                                <select name="cbstate" id="cbstate" class="form-control js-example-basic-single is-valid" style="width: 100%;">
                                    <option value="1">Disponible</option>
                                    <option value="2">No Disponible</option>
                                </select>
                            </div>
                        </div>
                                        

                      </div>


                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger"  data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cerrar Ventana</font></font></button>
                        <button type="button"  class="btn btn-outline-success btnsave"  onclick="saveObjData()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Guardar Artículo</font></font></button>
                      </div>


                    </div>
                 </div>
            </div>
        </form>
         
     </div>

    <div class="row">
        <!-- modal for inser and update -->
        <form onsubmit="return false" id="formartphoto" autocomplete="off">
            <div class="modal fade " id="modalphotoarticle" role="dialog"> 
                <div class="modal-dialog modal-lg modal-dialog-top ">
                    <div class="modal-content">
                      
                        <div class="modal-header bg-info">  
                            <h3 class="modal-title text-white"><b>FOTO DE: </b> <span class="border-bottom" id="imgnameprod"></span> </h3>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" value="" id="skuart">
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="form-label">Seleccione una imagen: <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" id="fileimg1" ref="fileimg1" class="form-control is-valid" id="fileimg1" placeholder="Seleccione una imagen"   required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-11" id="secimg">
                                    
                                    

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger"  data-dismiss="modal">
                                <font style="vertical-align: inherit;">Cerrar Ventana</font>
                            </button>
                            <button type="button"  class="btn btn-outline-success btnsave"  onclick="uploadimg()">
                                <font style="vertical-align: inherit;">Guardar Imagen</font>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        
    </div>


</div>









<script src="assets/js/articles.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/2.0.3/css/Jcrop.min.css">
<script type="text/javascript" src="assets/jquery.Jcrop.min.js"></script>
 -->
<script>
$(document).ready(function() {
    let name = " ";
    let limit = 100;
    listArticles(name,limit);

    //inicializamos el combo
    $(".js-example-basic-single").select2();
    //focus en input usuario
    $("#modal_editupdate").on('shown.bs.modal',function(){
        $("#namea").focus();  
    })

    // uplod img
    /*var size;
        $('#RecortarImagen').Jcrop({
          aspectRatio: 1,
          onSelect: function(c){
           size = {x:c.x,y:c.y,w:c.w,h:c.h};
           $("#recortar").css("visibility", "visible");     
           $("#descargar").css("visibility", "visible");     
          }
        });
     
        $("#recortar").click(function(){
            var img = $("#RecortarImagen").attr('src');
            $("#imgrecortada_img").show();
            $("#descargar").show();
           //$("#imgrecortada_img").attr('src','ImagenRecortada.php?x='+size.x+'&y='+size.y+'&w='+size.w+'&h='+size.h+'&img='+img);
        });*/


});

</script>