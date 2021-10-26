<?php

require_once dirname(__FILE__).'/../../models/Purchase.php';
require_once dirname(__FILE__).'/../../getcookie.php';

$inicio = isset($_POST['finicio']) ?   htmlspecialchars($_POST['finicio'],ENT_QUOTES, "UTF-8") : "";
$fin = isset($_POST['ffin']) ? htmlspecialchars($_POST['ffin'],ENT_QUOTES, "UTF-8") : "";
$name = isset($_POST['names']) ? htmlspecialchars($_POST['names'],ENT_QUOTES, "UTF-8") : " ";


	

$array = array();

if ($inicio != "" && $fin != "") {		
				
	session_start();
	if(isset($_COOKIE['token']) && isset($_SESSION['idbus'])){
			
		$idbus = $_SESSION['idbus'];
		$user = ValidToken::decodeToken('example_key');	
		$idus = sqrt($user['user']);

		$purchase = new Purchase();
		$res = $purchase->listByFilterPurchase($inicio, $fin, $name, $idbus);

		if($res!=0){
			if(count($res)>0){
				$array[0]='0';
				$array[1]=$res;
				echo json_encode($array);					
			}else{
				$array[0]="1";
				$array[1]="No hay registros de compras!";
				echo json_encode($array);
			}

		}else{
			$array[0]="1";
			$array[1]="No hay registros de compras!";
			echo json_encode($array);
		}

	}else{
		$array[0]="1";
		$array[1]="No tiene autorización!";
		echo json_encode($array);
	}

}






