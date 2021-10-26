<?php

use Firebase\JWT;

require '../library/php-jwt-54/JWT.php';


date_default_timezone_set('America/Lima');
$user = new Worker();
$time = time();	//tiempo en segundos //date('Y-m-d H:i:s') ;
$key = "example_key";

$this->iduser = 1;
$this->token =  array(
	'iat'=>$this->time, 			// tiempo de inicio de token
	'exp'=>$this->time + (60*60), 	// Duracion del token 1 hora
	'idUsuario'=>$this->iduser
);
			// iniciamos el token
$jwt = JWT::encode($this->token, $this->key);
$decoded = JWT::decode($jwt, $this->key, array('HS256'));

			//print_r($jwt);
print_r($decoded);



?>