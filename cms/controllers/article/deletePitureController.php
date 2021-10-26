<?php

require_once dirname(__FILE__). '/../../models/Picture.php';
require_once dirname(__FILE__). '/../../getcookie.php';

header('Access-Control-Allow-Origin:*');


$idpic = isset($_POST['idpic']) ? htmlspecialchars($_POST['idpic'],ENT_QUOTES) : "";
$nameimg = isset($_POST['file']) ? htmlspecialchars($_POST['file'],ENT_QUOTES) : "";

$array = array();

if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	if($user!=0){
		$idu = sqrt($user['user']);
		if($idpic != ""){
			
			session_start();
			if(isset($_SESSION['idbus'])){

				$idbus = $_SESSION['idbus'];

					$picture = new Picture();
					$result = $picture->deletePictureArticle($idpic);

					if ($result==1) {
						$rutalogo    = "../../assets/images/";

						unlink($rutalogo . $nameimg);

						$array[0]=0;
						$array[1]= "Imagen Actualizado";

						echo json_encode($array);

					
					}else{
						$array[0] =1;
						$array[1] ="Imagen no actualizado";
						echo json_encode($array);
					}

				
				
			}else{
				$array[0] =1;
				$array[1] ="Session exiprada";
				echo json_encode($array);
			}	
				
		}else{
			$array[0] =1;
			$array[1] ="Campo codigo no puede ser vacío";
			echo json_encode($array);
		}	

	}else{
		$array[0] =1;
		$array[1] ="Session Expirada";
		echo json_encode($array);
	}

}else{
	$array[0] =1;
	$array[1] ="No tiene permiso";
	echo json_encode($array);
}

