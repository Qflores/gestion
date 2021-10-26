<?php

require_once dirname(__FILE__). '/../../models/Business.php';
require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');

$req=array();

if(isset($_COOKIE['token'])):
	$user = ValidToken::decodeToken('example_key');
	if($user!=0):
		$idu = sqrt($user['user']);	
		$business = new Business();
		$result = $business->searchbyIdPerson($idu);
		if(count($result)>0):
			$idselect="0";

			session_start();
			if (isset($_SESSION['idbus'])) {
				$idselect = $_SESSION['idbus'];
			}

			$req[0]="1";
			$req[1]=$result;
			$req[2]=$idselect;
			echo json_encode($req);
		else:
			$req[0]="2";
			$req[1]="No tienes Empresas Creadas";
			echo json_encode($req);
		endif;
	else:
		$req[0]="2";
		$req[1]="Su session a expirado";		
		echo json_encode($req);
	endif;
else:
	echo json_encode("Does not have authorization P!");
endif;
