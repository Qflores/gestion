<script src="views/kardex/vuekardex.js "> </script>

<div class="col-md-12 col-sm-12" id="app">
	<div class="dashboard_graph">

		 <!-- Title secction -->
	    <div class="row x_title">
	        <div class="col-md-6">
	          <h3>KARDEX</h3>
	        </div>
	        <div class="col-md-6">
	          <h2>ADMINISTRAR </h2>
	        </div>
	    </div>



		<form autocomplete="false" onsubmit="return false">
		              
			<div class="modal-header bg-info">  
				<h4 class="modal-title text-white">Subir Excel con los articulos</h4>
				
			</div>

		  	<div class="modal-body">       
				<div class="form-group row">
		            <label class="col-sm-3 col-form-label" for="form-label">Descargar modelo de excel</label>
		            <div class="col-sm-9">
		                <button type="button" @click="filedowload" class="btn btn-outline-dark" id="filedow">
		                	<i class="fa fa-file-excel-o" style="color: #059C00FF; font-size: 20px;"></i> Descargar modelo
		                </button>
		            </div>
		        </div>  
		        <h4 class="modal-title text-white">Subir formato excel</h4>
		        <div class="form-group row">
		            <label class="col-sm-3 col-form-label" for="form-label">Seleccione un archivo para subir</label>
		            <div class="col-sm-9">
		                <input type="file" id="file" ref="file" class="form-control"  v-on:change="handleFileUpload">
		            </div>
		            <div class="col-sm-9">
		                <button class="btn btn-outline-danger" id="savefile" @click="UploadFile">Subir Archivo</button>
		            </div>
		        </div>                   

		  	</div>


		             


		       
		</form>











	</div>
</div>