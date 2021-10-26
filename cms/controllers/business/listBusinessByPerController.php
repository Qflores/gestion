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
		$result = $business->listBusByPerson($idu);		
		if($result!=0):
			if(count($result)>0):
				$req[0]="1";
				$req[1]=$result;
				echo  json_encode($req);
			else:
				$req[0]="0";
				$req[1]='No hay empresas';
				echo  json_encode($req);
			endif;
		else:
			$req[0]="0";
			$req[1]="no hay datos";
			echo  json_encode($req);
		endif;
	else:
		$req[0]="0";
		$req[1]="usuario no permitido";
		echo  json_encode($req);
	endif;
else:
	echo  json_encode(0);
endif;
