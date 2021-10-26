<?php

require_once dirname(__FILE__).'/../../models/Worker.php';
require_once dirname(__FILE__).'/../../getcookie.php';

header('Access-Control-Allow-Origin:*');

if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	if($user!=0){

		$idu = sqrt($user['user']);
		$person = new Worker();
		$info = $person->gerPerfilPerson($idu);

		if($info!=0){
			echo json_encode($info);
		}else{
			echo json_encode("No hay clientes Registrados");
		}
		
	}else{
		echo json_encode("Su session a caducado");
	}
	
}else{
	echo json_encode("Does not have authorization IP!");
}
