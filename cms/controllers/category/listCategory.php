<?php

require_once dirname(__FILE__)."/../../models/Category.php";
header('Access-Control-Allow-Origin:*');

	$category = new Category();

	$result = $category->listAllCategory();

	

	if(count($result['data'])>0){
		
		 echo json_encode($result);
	}else{

		echo "no hay resultados";
	}


