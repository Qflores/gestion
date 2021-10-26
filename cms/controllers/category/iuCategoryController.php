<?php

require_once dirname(__FILE__). '/../../models/Category.php';
header('Access-Control-Allow-Origin:*');

$namea = (isset($_POST['name']))? htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8'): "";


$array = array();

if($namea !=""){
	
	$category = new Category();

	$result = $category->saveCategory($namea);

	if(is_numeric($result)){
		if ($result>0) {
			$array[0]=0;
			$array[1]='Categoría Guardado';
			echo json_encode($array);
		}else{
			$array[0]=1;
			$array[1]='Error: Categoría no se guardó';
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
