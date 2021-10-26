<?php

require_once dirname(__FILE__). '/../../models/Customer.php';
require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');

if(isset($_COOKIE['token'])):
	$user = ValidToken::decodeToken('example_key');
	if($user!=0):
		$docname =(isset($_POST['rucname']))? htmlspecialchars($_POST['rucname']): "";
		$idu = sqrt($user['user']);	
		$customer = new Customer();
		$result = $customer->searchbyName($docname);
		if(count($result)>0):
			 echo json_encode($result);
		else:
			echo json_encode("No hay clientes Registrados");
		endif;
	else:
		echo json_encode("Su session a caducado");
	endif;
else:
	echo json_encode("Does not have authorization IP!");
endif;