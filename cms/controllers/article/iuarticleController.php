<?php

require_once dirname(__FILE__). '/../../models/Product.php';
require_once dirname(__FILE__). '/../../getcookie.php';
header('Access-Control-Allow-Origin:*');

$skua = (isset($_POST['skua']))? htmlspecialchars($_POST['skua'],ENT_QUOTES, 'UTF-8'): "";
$namea = (isset($_POST['namea']))? htmlspecialchars($_POST['namea'],ENT_QUOTES, 'UTF-8'): "";
$pricea = (isset($_POST['pricea']))? htmlspecialchars($_POST['pricea'],ENT_QUOTES, 'UTF-8'): "";
$cantya = (isset($_POST['cantya']))? htmlspecialchars($_POST['cantya'],ENT_QUOTES, 'UTF-8'): "";
$cbcat = (isset($_POST['cbcat']))? htmlspecialchars($_POST['cbcat'],ENT_QUOTES, 'UTF-8'): "";
$cbsize = (isset($_POST['cbsize']))? htmlspecialchars($_POST['cbsize'],ENT_QUOTES, 'UTF-8'): "";
$cbmarca = (isset($_POST['cbmarca']))? htmlspecialchars($_POST['cbmarca'],ENT_QUOTES, 'UTF-8'): "";
$cbstate = (isset($_POST['cbstate']))? htmlspecialchars($_POST['cbstate'],ENT_QUOTES, 'UTF-8'): "";
$newarticle = (isset($_POST['newarticle']))? htmlspecialchars($_POST['newarticle'],ENT_QUOTES, 'UTF-8'): "";

$priceab = (isset($_POST['priceab'])) ? htmlspecialchars($_POST['priceab'], ENT_QUOTES, 'UTF-8') : "";
$impa = (isset($_POST['impa'])) ? htmlspecialchars($_POST['impa'], ENT_QUOTES, 'UTF-8') : "";
$isca = (isset($_POST['isca'])) ? htmlspecialchars($_POST['isca'], ENT_QUOTES, 'UTF-8') : "";
$mina = (isset($_POST['mina'])) ? htmlspecialchars($_POST['mina'], ENT_QUOTES, 'UTF-8') : "";
$maxa = (isset($_POST['maxa'])) ? htmlspecialchars($_POST['maxa'], ENT_QUOTES, 'UTF-8') : "";
$sizea = (isset($_POST['sizea'])) ? htmlspecialchars($_POST['sizea'], ENT_QUOTES, 'UTF-8') : "";
$stock = (isset($_POST['stock'])) ? htmlspecialchars($_POST['stock'], ENT_QUOTES, 'UTF-8') : "";



if(isset($_COOKIE['token'])){
	$user = ValidToken::decodeToken('example_key');
	
	if($user!=0){
		$idu = sqrt($user['user']);
		session_start();
		if (isset($_SESSION['idbus'])) {			
			$idbus = $_SESSION['idbus'];

			if($skua !="" && $namea !="" && $pricea !="" && $cantya !="" && $cbcat !="" && $cbsize !="" && $cbmarca !="" && $cbstate !="" && $idbus !=""){
				$producto = new Product();

				$result = $producto->saveUpdateArticle($skua, $namea, $pricea, $cantya, $cbcat, $cbsize, $cbmarca,$cbstate,$newarticle,$priceab, $impa, $isca, $mina, $maxa, $sizea, $idbus,$stock);
				if($result!=0){
					 echo json_encode($result);
				}else{
					echo json_encode("El producto no se puso actualizar. ".$result);
				}
			}else{
				echo json_encode("Ingrese Los campos Obligatorios");
			}
		}else{
			echo json_encode("Debe seleccionar una empresa");
		}
	}else{
		echo json_encode("Su session a expirado");
	}
}else{
	echo json_encode("No Tiene permiso para este recurso");
}


