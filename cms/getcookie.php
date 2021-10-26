<?php

use \Firebase\JWT\JWT;
require_once dirname(__FILE__).'./library/php-jwt-54/JWT.php';
require_once dirname(__FILE__).'./models/Worker.php';

class ValidToken{

	public static  function decodeToken($key){
		try {
			if(isset($_COOKIE['token'])){
				
				$jwt = $_COOKIE['token'];				
				$decoded =JWT::decode($jwt, $key, array('HS512'));

				$deco = json_decode(json_encode($decoded),true);

				if(self::tokenTimeValid($decoded)){
					return $deco;
				}else{

					$newjwt = self::tokenRefres($decoded, $key);
					$dec = JWT::decode($newjwt, $key, array('HS512'));
					$newdec = json_decode(json_encode($dec),true);
					return $newdec;
				}

			}else{
				return 0;
			}
										
		} catch (\JWTDecodeFailureException $e) {
			return 0;
		}
	}//end decodtoken


	public static function tokenTimeValid($token){
		date_default_timezone_set('America/Lima');
		$fechaactual = time();
		$cook = json_decode(json_encode($token),true);
		$exp = (int)$cook['exp'];
		$resta = ($exp-$fechaactual)/60;
		if($resta>20){
			return true;
		}else{
			return false;
		}		
	}//end token time valid

	public static function tokenRefres($token,$key){

		date_default_timezone_set('America/Lima');
		$timeactual = time();
		$timeexpire = time()+60*60*2;
		$cook = json_decode(json_encode($token),true);
		$idus = $cook['user'];

		$payload =  array(
			'iss'=> "http://localhost:90/gestion",
      		'aud'=> "http://example.com",
			'iat'=>$timeactual,
			'exp'=>$timeexpire,
			'user'=>$idus,
		);

		setcookie('token', '', time()-1000, '/');

		$jwt = JWT::encode($payload, $key,'HS512');

		setcookie("token",$jwt,$timeexpire,"/");

		return $jwt;

	}//end token refres
}	


//$token = ValidToken::decodeToken('example_key');
//var_dump($token);
//$var = json_decode(json_encode($token),true);
//var_dump($var);
