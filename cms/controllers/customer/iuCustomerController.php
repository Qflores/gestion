<?php

require_once dirname(__FILE__). '/../../models/Customer.php';

$idc =(isset($_POST['idc']))? htmlspecialchars($_POST['idc']): "";
$namec = (isset($_POST['namec']))? htmlspecialchars($_POST['namec'],ENT_QUOTES, 'UTF-8'): "";
$emailc = (isset($_POST['emailc']))? htmlspecialchars($_POST['emailc'],ENT_QUOTES, 'UTF-8'): "0";
$docc = (isset($_POST['docc']))? htmlspecialchars($_POST['docc'],ENT_QUOTES, 'UTF-8'): "0";
$phonec = (isset($_POST['phonec']))? htmlspecialchars($_POST['phonec'],ENT_QUOTES, 'UTF-8'): "0";
$addressc = (isset($_POST['addressc']))? htmlspecialchars($_POST['addressc'],ENT_QUOTES, 'UTF-8'): "0";
$cbstate = (isset($_POST['cbstate']))? htmlspecialchars($_POST['cbstate'],ENT_QUOTES, 'UTF-8'): "1";


if($idc !="" && $namec !=""  &&  $docc !="" &&  $cbstate !=""){
	
	$customer = new Customer();

	$result = $customer->saveUpdateCustomer($idc, $namec, $emailc, $phonec, $docc, $addressc, $cbstate);

	if($result){
		 echo json_encode($result);
	}else{
		echo json_encode($result);
	}
}else{
	echo json_encode("Ingrese Los campos Obligatorios");
}

