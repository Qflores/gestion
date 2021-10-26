<?php

require_once dirname(__FILE__). '/../../models/Product.php';
require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');


$sku = (isset($_POST['sku']))? htmlspecialchars($_POST['sku'],ENT_QUOTES, 'UTF-8'): "";
$name = (isset($_POST['name']))? htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8'): "";
$price = (isset($_POST['price']))? htmlspecialchars($_POST['price'],ENT_QUOTES, 'UTF-8'): "";
$canty = (isset($_POST['canty']))? htmlspecialchars($_POST['canty'],ENT_QUOTES, 'UTF-8'): "";
$idbus = (isset($_POST['idbus']))? htmlspecialchars($_POST['idbus'],ENT_QUOTES, 'UTF-8'): "";
$iva = (isset($_POST['iva']))? htmlspecialchars($_POST['iva'],ENT_QUOTES, 'UTF-8'): "";

$array = array();

if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	if($user!=0){
		//$idu = sqrt($user['user']);
		session_start();

		if (isset($_SESSION['idbus'])) {			
			if($sku !="" && $name !="" && $price !="" && $canty !="" && $idbus !="" && $iva !=""){
				$producto = new Product();
				$res = $producto->addProdfast($sku, $name, $price, $canty, $idbus, $iva);
				if($res!=0){
					$array[0]=0;
					$array[1]='Producto Agregado';
					echo json_encode($array);					
				}else{
					$array[0]=1;
					$array[1]='No se pudo Guardar el Producto';
					echo json_encode($array);
				}

			}else{
				$array[0]=1;
				$array[1]='Complete los campos obligatorios';
				echo json_encode($array);
			}		

		}else{
			$array[0]=1;
			$array[1]='primero debe selesccionar una empresa en configuraciones';
			echo json_encode($array);
		}
	}else{
		$array[0]=1;
		$array[1]='Su ssesion a expirado';
		echo json_encode($array);
	}
}else{
	$array[0]=1;
	$array[1]='NO tien permiso para esta operación';
	echo json_encode($array);
}
