
<div class="" id="app">
	<div class="page-title" style="display: flex; position: relative;">
		<div class="title_left">
			<h3>DATOS DE MI EMPRESA</h3>
		</div>
		<div class="title_center" @click="newBusiness">
			<a  class="btn btn-app btn-outline-success" @click="newBusiness" >
              <span class="badge bg-green">Crear Nueva Empresa</span>
               <i class="btn-outline-primary fa fa-users"></i> 
            </a>
		</div>

		<div class="title_right">
			<div class="col-md-5 col-sm-5  form-group pull-right top_search">
				<div class="input-group">

					<input type="text" class="form-control" placeholder="buscar por...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">BUSCAR</button>
					</span>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
				<div class="x_title">
					<h2>Lista de  empresas <small> Principales</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>					
				</div>

				<div class="x_content">
					<div class="table-responsive">
	                    <table class="table jambo_table bulk_action">	
	                    	<thead>
	                          <tr class="headings">                            
	                            <th class="column-title">Razon Social</th>
	                            <th class="column-title">RUC</th>
	                            <th class="column-title">Dirección</th>
	                            <th class="column-title">Teléfono</th>
	                            <th class="column-title">Sucursal </th>
	                            <th class="column-title">IGV</th>
	                            <th class="column-title">Logo</th>
	                            <th class="column-title">Opciones</th> 
	                          </tr>
	                        </thead>
	                        <tbody>
	                          <tr class="even pointer" v-for="(b, index) in businesslista" :class="['bg', busselected==b.ido ? 'bg-warning':'']">
	                            <th class="">{{b.nameb}}</th>
	                            <th class="">{{b.rucb}}</th>
	                            <th class="">{{b.address}}</th>
	                            <th class="">{{b.phone}}</th>
	                            <th class="">{{b.nombre}}</th>
	                            <th class="">{{b.iva*100}}</th>
	                            <th class=""><img v-bind:src="'./assets/images/'+b.logob" width="45"> </th>
	                            <th class="">
	                            	<button class="btn btn-outline-primary btn-sm" @click="editBusiness(index)">Editar</button>
	                            	<button title="Crear Nueva Sucursal" class="btn btn-outline-info btn-sm" @click="newOffice(index)">
	                            		<i class="glyphicon glyphicon-plus" ></i>
	                            	</button>

	                            </th>
	                          </tr>                          
	                        </tbody>
	                    </table>
	                </div>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
				<div class="x_title">
					<h2>Datos de la empresa <small> Seleccionada</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
							<!-- @click="editactive ? editactive=false : editactive=true" -->
							<a class="collapse-link">
							<i :class="['fa ', editactive? 'fa-chevron-up':'fa-chevron-down']"></i>
						</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" :class="[editactive ? 'd-block':'d-none']" >
					<br />
					<form id="demo-form2" autocomplete="false" onsubmit="return false" data-parsley-validate class="form-horizontal form-label-left">
						<div class="item form-group">

							<input type="hidden" v-model="idb">
							<input type="hidden" v-model="ido">

							<label class="col-form-label  col-sm-3 label-align" for="first-name">Razon Social: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="text" v-model="name" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">RUC/Cedula: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="number" v-model="ruc" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nombre Office: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="text" v-model="nombre" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Direccion: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="text" v-model="address" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="number" v-model="phone" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="text" v-model="email" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Zona Horaria: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">						
								<select v-model="timezone"  class="form-control ">
									<option selected="" disabled="" value="0">Seleccione Zona Horaria</option>
									<option v-for="(m, index) in zonas" :value="m.name">{{m.name}}</option>
								</select>
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nombre de la impresora: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="text" v-model="printer" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Ip de pc Central: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="text" v-model="printerhost" value="localhost" required="required" class="form-control">
							</div>
						</div>

						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Ingrese Impuesto %: <span class="required is-invalid">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="number" v-model="iva" required="required" class="form-control" placeholder="ejemplo: 10">
							</div>
						</div>

						<div class="item form-group">
							<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Logo</label>
							<div class="col-md-6 col-sm-6 ">
								<input type="file" id="file" ref="file" v-bind:class="[selectlogo]" class="form-control " v-on:change="setfile">
							</div>
						</div>

						<div class="item form-group">
							<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Lista de monedas</label>
							<div class="col-md-6 col-sm-6 ">
								<select  v-model="idm" class="form-control" >
									<option value="0">Seleccione moneda</option>
									<option v-for="(m, index) in money"  v-bind:value="m.id">{{m.name}}</option>
								</select>
							</div>
						</div>

						<div class="ln_solid" ref="formbusiness"></div>
						<div class="item form-group">
							<div class="col-md-6 col-sm-6 offset-md-3">
								<button class="btn btn-primary" type="button">Cancel</button>
								<button class="btn btn-primary" type="reset">Borrar</button>
								<button type="submit" class="btn btn-success" @click="saveBusiness">Guardar</button>
							</div>
						</div>

					</form>
					</div>
				</div>
			</div>
			
		</div>
	</div>


	<!-- modal paar editar y agregar Office -->
	<form autocomplete="false" onsubmit="return false">
	    <div class="modal fade " id="modal_editupdate" role="document"> 
	        <div class="modal-dialog modal-lg modal-dialog-centered ">
	            <div class="modal-content">
	              
	              <div class="modal-header bg-info">  
	                <h3 class="modal-title text-white"><b>Formulario de Sucursal</b></h3>
	                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
	              </div>

	              <div class="modal-body">
	                <input type="hidden" v-model="ido" id="newsupplier">
	                <div class="form-group row" >
	                    <label class="col-sm-3 col-form-label" for="form-label">Nombre de sucursal: <span class="required text-danger">*</span></label>
	                    <div class="col-sm-9">
	                        <input type="text" v-model="nombre" class="form-control is-valid" id="namep" placeholder="Ingrese nombre razon social" maxlength="80" minlength="1" required>
	                    </div>
	                </div>

	                <div class="form-group row">
	                    <label class="col-sm-3 col-form-label" for="form-label">Dirección: <span class="required text-danger">*</span></label>
	                    <div class="col-sm-9">
	                        <input type="text" v-model="address" class="form-control is-valid" id="addressp" placeholder="Ingrese la Direccion"  minlength="3" maxlength="100" required>
	                    </div>
	                </div>

	                <div class="form-group row">
	                    <label class="col-sm-3 col-form-label" for="form-label">Teléfono: <span class="required text-danger">*</span></label>
	                    <div class="col-sm-9">
	                        <input type="number"  v-model="phone" min="0" maxlength="15" class="form-control is-valid"  placeholder="Ingrese el número de teléfono"> 
	                    </div>
	                </div>

	                <div class="form-group row">
	                    <label class="col-sm-3 col-form-label" for="form-label">Correo: <span class="required text-danger">*</span></label>
	                    <div class="col-sm-9">
	                         <input type="text" v-model="email" min="0" maxlength="55" class="form-control is-valid"  placeholder="Ingrese el correo">
	                    </div>
	                </div>
	                <div class="form-group row">
						<label class=" col-sm-3 label-align" for="last-name">Nombre de la impresora: <span class="required text-danger">*</span>
						</label>
						<div class="col-sm-9">
							<input type="text" v-model="printer" required="required" class="form-control is-valid" placeholder="Ejemplo: postVenta">
						</div>
					</div>

					<div class="form-group row">
						<label class="  col-sm-3 label-align" for="last-name">Ip de pc Central: <span class="required text-danger">*</span>
						</label>
						<div class="col-md-9">
							<input type="text" v-model="printerhost" value="localhost" required="required" class="form-control is-valid" placeholder="localhost">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 label-align" for="last-name">Ingrese Impuesto %: <span class="required text-danger">*</span>
						</label>
						<div class="col-md-9">
							<input type="number" v-model="iva" required="required" class="form-control is-valid" placeholder="ejemplo: 10">
						</div>
					</div>

	                <div class="form-group row">
	                    <label class="col-sm-3 label-align" for="form-label">Zona Horaria: <span class="required text-danger">*</span></label>
	                    <div class="col-sm-9">
	                    	<select v-model="timezone"  class="form-control is-valid">
								<option selected="" disabled="" value="0">Seleccione Zona Horaria</option>
								<option v-for="(m, index) in zonas" :value="m.name">{{m.name}}</option>
							</select>	                       
	                    </div>
	                </div>

	                <div class="form-group row">
	                    <label class="col-sm-3 col-form-label" for="form-label">Moneda: <span class="required text-danger">*</span></label>
	                    <div class="col-sm-9">
	                        <select  v-model="idm" class="form-control is-valid" >
									<option value="0">Seleccione moneda</option>
									<option v-for="(m, index) in money"  v-bind:value="m.id">{{m.name}}</option>
							</select>
	                    </div>
	                </div>
	                                

	            </div>


	              <div class="modal-footer">
	                <button type="button" class="btn btn-outline-danger"  data-dismiss="modal">
	                	<font style="vertical-align: inherit;">Cerrar Ventana</font>
	                </button>
	                <button type="button"  class="btn btn-outline-success btnsave"  @click="saveOffice">
	                	<font style="vertical-align: inherit;">Guardar Sucursal</font>
	                </button>
	              </div>


	            </div>
	         </div>
	    </div>
	</form>


</div>
<!-- end app -->







<script src="views/business/vueiabusiness.js"> </script>

<script>
	$(document).ready(function() {
		$(".js-example-basic-single").select2();
	});
	
</script>