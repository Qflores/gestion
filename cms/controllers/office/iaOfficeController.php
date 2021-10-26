
<?php

require_once dirname(__FILE__).'/../../models/Office.php';
require_once dirname(__FILE__).'/../../getcookie.php';
header('Access-Control-Allow-Origin:*');
//header('Content-Type: application/json');
//header('Content-type: application/x-www-form-urlencoded');
header("Content-type: application/json; charset=utf-8");
$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

$req=array();

if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	if($user!=0)
	{
		$idu = sqrt($user['user']);
		
		//empresa
		$idb = isset($_POST['idb']) ? htmlspecialchars($_POST['idb'], ENT_QUOTES, 'UTF-8') : "";	

		//office		
		$idof = isset($_POST['idof']) ? htmlspecialchars($_POST['idof'] , ENT_QUOTES, 'UTF-8') : "";
		$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre'] , ENT_QUOTES, 'UTF-8') : "";
		$address = isset($_POST['address']) ? htmlspecialchars($_POST['address'] , ENT_QUOTES, 'UTF-8') : "";
		$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone'] , ENT_QUOTES, 'UTF-8') : "";
		$timezone = isset($_POST['timezone']) ? htmlspecialchars($_POST['timezone'] , ENT_QUOTES, 'UTF-8') : "";
		$printer = isset($_POST['printer']) ? htmlspecialchars($_POST['printer'] , ENT_QUOTES, 'UTF-8') : "";
		$printerhost = isset($_POST['printerhost']) ? htmlspecialchars($_POST['printerhost'] , ENT_QUOTES, 'UTF-8') : "";
		$keypos = isset($_POST['keypos']) ? htmlspecialchars($_POST['keypos'] , ENT_QUOTES, 'UTF-8') : "";
		$iva = isset($_POST['iva']) ? htmlspecialchars($_POST['iva'] , ENT_QUOTES, 'UTF-8') : "";
		$idmoneda = isset($_POST['idmoneda']) ? htmlspecialchars($_POST['idmoneda'] , ENT_QUOTES, 'UTF-8'): "";
		$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'] , ENT_QUOTES, 'UTF-8'): "";
		

		if($idb !="" &&  $idof !="" && $nombre !="" && $address !="" && $phone !="" && $timezone !="" && $iva !="" && $idmoneda !=""){

			$business = new Office();
			$result = $business->saveUpdateOffice($idu, $idb,$idof,$nombre,$address,$phone,$timezone,$printer,$printerhost,$keypos,$iva,$idmoneda,$email);

			if($result===1){
				$code = 200;
				$text = 'OK /Created';
				header($protocol . ' ' . $code . ' ' . $text);
			}else{
				$code = 304;
				$text = 'Not Modified';
				header($protocol . ' ' . $code . ' ' . $text);
			}
		}else{
			$code = 304;
			$text = 'Complete los campos obligatorios';
			header($protocol . ' ' . $code . ' ' . $text);
		}				

	}else{
		$code = 304;
		$text = 'Su sessión a expirado, vuelva ainciar la sesion';
		header($protocol . ' ' . $code . ' ' . $text);
	}	
}else{	
	$code = 401;
	$text = 'Unauthorized: Does not have authorization IP!';
	header($protocol . ' ' . $code . ' ' . $text);
	
}
