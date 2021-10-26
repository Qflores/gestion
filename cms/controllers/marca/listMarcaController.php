<?php

	require_once dirname(__FILE__).'/../../models/Marca.php';

	$marca = new Marca();

	$result = $marca->listAllMarca();
	if(count($result['data'])>0){
		
		 echo json_encode($result);
	}else{

		echo "no hay resultados";
	}

