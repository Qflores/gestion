
<?php

require_once dirname(__FILE__)."/../../models/Voucher.php";

header('Access-Control-Allow-Origin:*');

	$voucher = new Voucher();

	$result = $voucher->listAllvoucher();

	$array = array();

	if(count($result)>0){
		$array[0]=0;
		$array[1]=$result;
		echo json_encode($array);

	}else{

		$array[0]=1;
		$array[1]='Primero registre los metodos de Operacion';
		echo json_encode($array);
	}



