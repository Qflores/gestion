<?php

require_once dirname(__FILE__).'/Zonahora.php';

	$zona = Zorahora::getZona();
	
	if(count($zona)>0){		
		 echo json_encode($zona);
	}else{
		echo json_encode("no hay resultados");
	}

