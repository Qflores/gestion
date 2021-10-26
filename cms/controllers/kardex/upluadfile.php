<?php

require_once dirname(__FILE__).'/../../models/Kardex.php';

$file = (isset($_FILES['file']))? $_FILES['file']: "";

	//var_dump($file['type']);


if($file['type']=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $file['type']=='application/vnd.ms-excel'){
	//5mb =1024*1024*5= 5.242.880
	//1mb = 1024*1024 = 1.048.576
	
	if ($file['size']<=5242880 && $file['size']>5120) {

		$rutasave = "../../files/";

		$guardado = $rutasave.basename($file['name']);

		if(move_uploaded_file($_FILES['file']['tmp_name'],$guardado)){
			echo json_encode("Archivo guardado".$file['name']);
		}


		$kardex = new Kardex();
		//$result = $kardex->upluodFile();	
		if(true){
			
			 echo json_encode("ok file upload");

		}else{

			echo json_encode("no hay resultados");
		}
		

	}else{
		echo json_encode("tamaño de archivo permitido 5mb max 5kb min.");
	}

	

}else{
	echo json_encode("Tipo de Archivo no permitido, solo se permite excel");
}

