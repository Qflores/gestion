<?php

require_once dirname(__FILE__). '/../models/Business.php';
require_once dirname(__FILE__). '/../getcookie.php';
header('Access-Control-Allow-Origin:*');

class Headprint {	
	static  function getHeadPrint(){
		$user = ValidToken::decodeToken('example_key');
		if($user!=0){
			
			$idu = sqrt($user['user']);

			$business = new Business();
			$lista  = $business->listForPrintByIdPerson();

			return $lista;
			
		}else{
			return 0;
		}		
	}
}
