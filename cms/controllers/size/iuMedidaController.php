<?php

require_once dirname(__FILE__).'/../../models/Size.php';

$namea = (isset($_POST['name']))? htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8'): "";
$symbol = (isset($_POST['symbol']))? htmlspecialchars($_POST['symbol'],ENT_QUOTES, 'UTF-8'): "";

$array = array();

if($namea != "" && $symbol!= ""){
	
	$size = new Size();

	$result = $size->saveSize($namea,$symbol);

	if(is_numeric($result)){
		if ($result>0) {
			$array[0]=0;
			$array[1]='Unidade de medida Guardado';
			echo json_encode($array);
		}else{
			$array[0]=1;
			$array[1]='Error: Unidad de medida no se guardó';
			echo json_encode($array);
		}
	}else{
		$array[0]=1;
		$array[1]='Error: '.$result;
		echo json_encode($array);
	}
}else{
	$array[0]=1;
	$array[1]='Ingrese Los campos Obligatorios';
	echo json_encode($array);
}
