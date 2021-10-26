<?php

	require_once dirname(__FILE__).'/../../models/Purchase.php';

	
	$iddet = isset($_POST['idpay']) ? htmlspecialchars($_POST['idpay'],ENT_QUOTES, "UTF-8") : "";

	$array= array();

	if ($iddet != "") {	

		$purchase = new Purchase();
		$res = $purchase->listdetailPurchase($iddet);
		
		if(count($res)>0){
			echo  json_encode($res);

		}else{
			$array[0]='2';
			$array[1]='No hay Compras Registradas';
			echo  json_encode($array);
		}

	}else{
		$array[0]='0';
		$array[1]='Los datos vacios no se permiten';

		echo json_encode($array);
	}
	

