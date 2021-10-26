<?php

require_once dirname(__FILE__).'/../../models/Person.php';
require_once dirname(__FILE__).'/../../getcookie.php';

$pass 	=isset($_POST['pass']) ? htmlspecialchars($_POST['pass'],ENT_QUOTES, "UTF-8") :"";
$idhead =isset($_POST['idhead']) ? htmlspecialchars($_POST['idhead'],ENT_QUOTES, "UTF-8") :"";

	if($pass!= "" && $idhead != ""){

		session_start();
		if(isset($_COOKIE['token']) && isset($_SESSION['idbus'])){
			
			$idbus = $_SESSION['idbus'];
			$user = ValidToken::decodeToken('example_key');	
			$idus = sqrt($user['user']);
			if(is_numeric($idus)){

				$person =  new Person();
				$res = $person->payAcountCustomer($idus, $pass, $idhead);
				if(is_numeric($res) && $res>0){
					echo json_encode('1');
				}else{
					echo json_encode('La cuenta no se pudo abonar');
				}
			}else{
				echo json_encode('Inicie la sessión');
			}

		}else{
			echo json_encode('No tiene permiso para esta accion');
		}

	}else{
		echo json_encode('Complete los campos Obligatorios');
	}
