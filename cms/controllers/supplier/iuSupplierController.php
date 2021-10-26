<?php

require_once dirname(__FILE__).'/../../models/Supplier.php';


$id = (isset($_POST['id']))? htmlspecialchars($_POST['id'],ENT_QUOTES, 'UTF-8'): "";
$namep = (isset($_POST['namep']))? htmlspecialchars($_POST['namep'],ENT_QUOTES, 'UTF-8'): "";
$nump = (isset($_POST['nump']))? htmlspecialchars($_POST['nump'],ENT_QUOTES, 'UTF-8'): "";
$addressp = (isset($_POST['addressp']))? htmlspecialchars($_POST['addressp'],ENT_QUOTES, 'UTF-8'): "";
$tipodoc = (isset($_POST['tipodoc']))? htmlspecialchars($_POST['tipodoc'],ENT_QUOTES, 'UTF-8'): "";
$phonep = (isset($_POST['phonep']))? htmlspecialchars($_POST['phonep'],ENT_QUOTES, 'UTF-8'): "";
$emailp = (isset($_POST['emailp']))? htmlspecialchars($_POST['emailp'],ENT_QUOTES, 'UTF-8'): "";
$serp = (isset($_POST['serp']))? htmlspecialchars($_POST['serp'],ENT_QUOTES, 'UTF-8'): "";
$idmoney = (isset($_POST['idmoney']))? htmlspecialchars($_POST['idmoney'],ENT_QUOTES, 'UTF-8'): "1";



$tipodoc = empty($tipodoc) ? "1" : $tipodoc;
$addressp = empty($addressp) ? "" : $addressp;
$phonep = empty($phonep) ? "" : $phonep;
$emailp = empty($emailp) ? "" : $emailp;
$serp = empty($serp) ? "" : $serp;
$idmoney = empty($idmoney) ? "1" : $idmoney;



if($id !="" && $namep !="" && $nump !=""){
	
	$supplier = new Supplier();

	$result = $supplier->saveUpdateSupplier($id, $namep, $addressp, $tipodoc, $nump, $phonep, $emailp, $serp, $idmoney);

	if($result){
		 echo json_encode($result);
	}else{

		echo json_encode($result);
	}
}else{
	echo json_encode("Ingrese Los campos Obligatorios");
}
?>