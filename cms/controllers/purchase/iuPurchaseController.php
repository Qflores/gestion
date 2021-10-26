<?php

	require_once dirname(__FILE__).'/../../models/Purchase.php';
	require_once dirname(__FILE__).'/../../getcookie.php';

	$idvoucher = htmlspecialchars($_POST['idvoucher'],ENT_QUOTES, "UTF-8");
	$idopera = htmlspecialchars($_POST['idopera'],ENT_QUOTES, "UTF-8");
	//$idworker = htmlspecialchars($_POST['idworker'],ENT_QUOTES, "UTF-8");
	$idsupplier = htmlspecialchars($_POST['idsupplier'],ENT_QUOTES, "UTF-8");
	$nfact = htmlspecialchars($_POST['nfact'],ENT_QUOTES, "UTF-8");	

	$post =$_POST['producto'];

	$data = json_decode($post, true);
	if (count($data)>0 &&  $idopera != "") {
		//recuperamos id usuario
		$user = ValidToken::decodeToken('example_key');	
		$idus = sqrt($user['user']);

		$purchase = new Purchase();
		$res = $purchase->saveOrder($data, $idvoucher, $idopera, $idus, $idsupplier, $nfact);
		
		if($res){
			$array[0]='1';
			$array[1]='registro satisfecho :'.$res;
			echo  json_encode($array);
		}else{
			$array[0]='2';
			$array[1]='registro fallido :'.$res;
			echo  json_encode($array);
		}

	}else{
		$array[0]='0';
		$array[1]='Los datos vacios no se permiten';
		echo json_encode($array);
	}
	


?>