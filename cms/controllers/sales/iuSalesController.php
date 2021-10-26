<?php

require_once dirname(__FILE__).'/../../models/Sales.php';
require_once dirname(__FILE__).'/../../getcookie.php';

	$idvoucher = htmlspecialchars($_POST['idvoucher'],ENT_QUOTES, "UTF-8");
	$descuento = htmlspecialchars($_POST['descuento'],ENT_QUOTES, "UTF-8");
	$state = htmlspecialchars($_POST['state'],ENT_QUOTES, "UTF-8");
	$idcustomer = htmlspecialchars($_POST['idcustomer'],ENT_QUOTES, "UTF-8");
	$nfact = htmlspecialchars($_POST['nfact'],ENT_QUOTES, "UTF-8");
	$post =$_POST['producto'];

	$array =array();
	$data = json_decode($post, true);

	session_start();
	if(isset($_COOKIE['token']) && isset($_SESSION['idbus'])){
		
		$idbus = $_SESSION['idbus'];

		$user = ValidToken::decodeToken('example_key');	

		$idus = sqrt($user['user']);

		if (count($data)>0 &&  $idus != "" && $idcustomer != "" && $idbus !="") {
				$purchase = new Sales();
				$res = $purchase->saveSales($data, $nfact, $descuento, $idbus,$idus, $idcustomer,$idvoucher, $state);

				if(is_numeric($res)){
					$array[0]='1';
					$array[1]=$res;
					echo  json_encode($array);
				}else{
					$array[0]='2';
					$array[1]='Venta Fallida: '.$res;
					echo  json_encode($array);
				}
			}else{
				$array[0]='0';
				$array[1]='Complete los campos obligatorios: Detalle venta, serie factura y Cliente';
				echo json_encode($array);
			}
	}else{
		$array[0]='3';
		$array[1]='Vuelva iniciar su session';
		echo  json_encode($array);
	}
