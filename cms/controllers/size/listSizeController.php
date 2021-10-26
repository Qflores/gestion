<?php

require_once dirname(__FILE__).'/../../models/Size.php';

	$size = new Size();
	$result = $size->listAllSize();	

	if(count($result['data'])>0){		
		 echo json_encode($result);
	}else{

		echo "no hay resultados";
	}

