<?php

	require_once dirname(__FILE__).'/../../models/Kardex.php';

	$kardex = new Kardex();

	$result = $kardex->generateKardex();
	
	if(count($result['data'])>0){
		
		 echo json_encode($result);
	}else{

		echo "no hay resultados";
	}

