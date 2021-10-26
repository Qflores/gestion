<?php

require_once dirname(__FILE__). '/../../models/Business.php';
require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');

$req=array();


if(isset($_COOKIE['token'])){

	$user = ValidToken::decodeToken('example_key');
	
	session_start();

	if($user!=0 && isset($_SESSION['idbus'])){
		
		$idu = sqrt($user['user']);

				
		$idb = $_SESSION['idbus'];

		$business = new Business();
		$result = $business->listByidBusByidUser($idu,$idb);
		
		if ($result!=0) {
			if(count($result)>0){
				$array[0]=0;
				$array[1]=$result;
				echo json_encode($array);
			}else{
				$array[0]=1;
				$array[1]="Empresa no existe";
				echo json_encode($array);
			}
		}else{
			$array[0] =1;
			$array[1] ="Empresa no encotrado";
			echo json_encode($array);
		}
	}else{
		$array[0] =1;
		$array[1] ="Session expirada";
		echo json_encode($array);
	}

}else{
	$array[0] =1;
	$array[1] ="No Tiene permiso";
	echo json_encode($array);
}
	
