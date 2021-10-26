<?php

require_once dirname(__FILE__).'/../../models/Kardex.php';
require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');

$idprod = (isset($_POST['skuprod']))?  htmlspecialchars($_POST['skuprod'], ENT_QUOTES, "UTF-8"): "";
$fecha = (isset($_POST['fecha']))?  htmlspecialchars($_POST['fecha'], ENT_QUOTES, "UTF-8"): "";

$req=array();

if($idprod != "" &&  $fecha !=""):
	if(isset($_COOKIE['token'])):
		$user = ValidToken::decodeToken('example_key');
		if($user!=0):
			$idu = sqrt($user['user']);	
			session_start();
			if (isset($_SESSION['idbus'])):
				$idbus = $_SESSION['idbus'];

				$kardex = new Kardex();
	 			$result = $kardex->getKardexBysku($idprod, $fecha, $idbus, $idu);
	 			if($result!=0):
					if(count($result)>0):						
						$req[0]="0";
						$req[1]=$result;
						echo json_encode($req);
					else:
						$req[0]="1";
						$req[1]="Ocurrió el siguiente error: ".$result;
						echo json_encode($req);
					endif;
				else:
					$req[0]="1";
					$req[1]='No hay resultados de kardex para este producto.';
					echo json_encode($req);
				endif;
			else:
				$req[0]="1";
				$req[1]="Debe seleccionar una Empresa";
				echo json_encode($req);
			endif;
		else:
			$req[0]="1";
			$req[1]="Su session a expirado";		
			echo json_encode($req);
		endif;
	else:
		$req[0]="1";
		$req[1]="Does not have authorization IP";
		echo json_encode($req);
	endif;

else:
	$req[0]="1";
	$req[1]="Debe Ingresar los datos oligatorios";
	echo json_encode($req);
endif;
