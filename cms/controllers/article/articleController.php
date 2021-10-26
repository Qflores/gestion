<?php

require_once dirname(__FILE__). '/../../models/Product.php';
require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');


$skuname = isset($_POST['skuname']) ? htmlspecialchars($_POST['skuname'],ENT_QUOTES, 'UTF-8') : " ";
$limit = isset($_POST['long'])  ? htmlspecialchars($_POST['long'],ENT_QUOTES, 'UTF-8') : "50";
if(isset($_COOKIE['token'])):
	$user = ValidToken::decodeToken('example_key');
	if($user!=0):

		session_start();
		if(isset($_SESSION['idbus'])){
			$idbus = $_SESSION['idbus'];
			$idu = sqrt($user['user']);	

			if($idbus !="" && $idu != ""){
				$producto = new Product();
				$result = $producto->listAllProductProd($idu, $idbus, $skuname, $limit);
				if($result !=0):
					echo json_encode($result);
				else:
					echo json_encode("No hay Articulos para mostrar");
				endif;
			}else{
				echo json_encode("Debe iniciar session o seleccionar una empresa");
			}
		}else{
			echo json_encode("Debe seleccionar una empresa en configuraciones");
		}
		
	else:
		echo json_encode("Su session a caducado");
	endif;
else:
	echo json_encode("Does not have authorization IP!");
endif;



