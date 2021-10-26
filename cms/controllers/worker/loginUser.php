
<?php

use \Firebase\JWT\JWT;

require_once dirname(__FILE__).'/../../library/php-jwt-54/JWT.php';
require_once dirname(__FILE__).'/../../models/Authentication.php';


class Login {

	private $user = null;

	private $time= null;
	private $exp= null;
	private $key = null;
	private $payload = null;
	private $iduser = null;
	public $request=null;

	public function __construct(){

		date_default_timezone_set('America/Lima');
		$this->user = new AuthToken();		
		$this->time = time();			//tiempo en segundos //date('Y-m-d H:i:s') ;
		$this->exp = $this->time+60*60;	//tiempo en segundos //date('Y-m-d H:i:s') ;
		$this->key = "example_key";		//llave secreta
		// establecemos paeloat
	}

	public function auth($user, $pass, $save){
		$loginok = $this->user->loginUsers($user, $pass);
		if($loginok[0]==1){
			$this->iduser=$loginok[1]*$loginok[1];
			// si marcó guardar session, se guarda por 2 horas
			if($save){
				date_default_timezone_set('America/Lima');
				$this->exp = time()+60*60*2;
			}

			//iniciamos payload
			$this->startPayload();
			//Creamos el token pasando paeload, la clave y codigo de codificacion			
			$jwt = JWT::encode($this->payload, $this->key,'HS512');			

			//creamos la session con el idusuario
			session_start();
		    if (isset($_SESSION['token'])) {
		        $_SESSION['token'] =$jwt;
		        $_SESSION['ux'] =$loginok;        
		    }else{
		        $_SESSION['token'] =$jwt;
		        $_SESSION['ux'] =$loginok;
		    }

		    //creamos la cookie pasando token, tiempo de expiracion y guardamos en el navegador			
			setcookie("token",$jwt, $this->exp,"/");
						
			//retornamos true
			return 1;

		}else{
			return $loginok; 
		}

	}// end valid


	public function startPayload(){
		$this->payload =  array(
			'iss'=> "http://localhost:90/gestion",
      		'aud'=> "http://example.com",
			'iat'=>$this->time,
			'exp'=>$this->exp,
			'user'=>$this->iduser
		);
	}
}




