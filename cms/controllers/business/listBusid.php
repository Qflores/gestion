<?php

require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');

$array = array();

if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	if($user!=0){
		$idu = sqrt($user['user']);
		$idb = isset($_POST['idb']) ? htmlspecialchars($_POST['idb'], ENT_QUOTES, 'UTF-8') : "";

		if($idb!=""){
			session_start();
			if (isset($_SESSION['idbus'])) {
				$_SESSION['idbus'] = $idb;
			}else{
				$_SESSION['idbus'] = $idb;
			}
			$array[0] =1;
			$array[1] ="success";
			echo json_encode($array);
		}else{
			$array[0]=2;
			$array[1] ="error";
			echo json_encode($array);
		}
	}else{
		$array[0]=3;
		echo json_encode($array);
	}
}else{
	$array[0]=4;
	echo json_encode($array);
}
