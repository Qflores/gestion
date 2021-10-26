<?php

require_once dirname(__FILE__).'/../../models/Supplier.php';
	

$array = array();

$idc =(isset($_POST['rucname']))? htmlspecialchars($_POST['rucname']): "";

$supplier = new Supplier();

$result = $supplier->searchBynameRuc($idc);

if(count($result)>0){
	 echo json_encode($result);
}else{
	echo json_encode("Proveedor no encontrado");
}

 
