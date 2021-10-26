
<?php

require_once dirname(__FILE__).'/../../models/Marca.php';

header('Access-Control-Allow-Origin:*');

$namea = (isset($_POST['name']))? htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8'): "";


$array = array();

if($namea !=""){
	
	$marca = new Marca();

	$result = $marca->saveMarca($namea);

	if(is_numeric($result)){
		if ($result>0) {
			$array[0]=0;
			$array[1]='Marca Guardado';
			echo json_encode($array);
		}else{
			$array[0]=1;
			$array[1]='Error: Marca no se guardó';
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

