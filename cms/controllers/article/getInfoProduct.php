<?php

require_once dirname(__FILE__). '/../../models/Product.php';
require_once dirname(__FILE__). '/../../getcookie.php';

header('Access-Control-Allow-Origin:*');


$sku = isset($_POST['sku']) ? htmlspecialchars($_POST['sku'],ENT_QUOTES) : "";

$array = array();

if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	if($user!=0){
		$idu = sqrt($user['user']);
		if($sku != ""){
			
			session_start();
			if(isset($_SESSION['idbus'])){

				$idbus = $_SESSION['idbus'];
				
				$producto = new Product();
				$result = $producto->getInfoProduct($sku);
				
				if ($result!=0) {
					if(count($result)>0){
						$array[0]=0;
						$array[1]=$result;
						echo json_encode($array);
					}else{
						$array[0]=1;
						$array[1]="Articulo no Encontrado";
						echo json_encode($array);
					}
				}else{
					$array[0] =1;
					$array[1] ="Articulo no registrado";
					echo json_encode($array);
				}
				
			}else{
				$array[0] =1;
				$array[1] ="Session exiprada";
				echo json_encode($array);
			}	
				
		}else{
			$array[0] =1;
			$array[1] ="Campo codigo no puede ser vacío";
			echo json_encode($array);
		}	

	}else{
		$array[0] =1;
		$array[1] ="Session Expirada";
		echo json_encode($array);
	}

}else{
	$array[0] =1;
	$array[1] ="No tiene permiso";
	echo json_encode($array);
}

