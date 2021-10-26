<?php

require_once dirname(__FILE__).'/../../models/Supplier.php';
require_once dirname(__FILE__).'/../../getcookie.php';	
// headers 
header('Access-Control-Allow-Origin:*');
//header('Content-type:application/json');
//primera forma fucional
/*$headers = apache_request_headers();
if(isset($headers['Authorization'])):
	//$token = str_replace('Bearer ','',$headers['Authorization']);	
	$user = ValidToken::decodeToken('example_key');	
	if($user!=0){
		$idu = sqrt($user['user']);		
	}	
endif;*/

//segunda forma funcional

if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	if($user!=0){
		$idu = sqrt($user['user']);	
		$supplier = new Supplier();
		$result = $supplier->listAllSupplier();		

		if(count($result['data'])>0){
			 echo json_encode($result);
		}else{
			echo json_encode("El no hay lista de productos");
		}
		
	}else{
		echo json_encode("Su session a caducado");
	}
	
}else{
	echo json_encode("Does not have authorization!");
}

