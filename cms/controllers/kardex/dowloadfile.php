<?php

require_once dirname(__FILE__).'/../../models/Kardex.php';

$idus = (isset($_FILES['idus']))? $_FILES['idus']: "";


if($idus != ""){

	$kardex = new Kardex();

	$ruta = "../../files/Lista de productos.xlsx";
	
	if(true){
		
		 echo json_encode($ruta);
	}else{

		echo "no hay resultados";
	}

}else{

	 echo json_encode("Token no valido");

}
	

