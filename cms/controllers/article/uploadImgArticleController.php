<?php

require_once dirname(__FILE__). '/../../models/Picture.php';
require_once dirname(__FILE__). '/../../getcookie.php';

header('Access-Control-Allow-Origin:*');

$sku = (isset($_POST['sku']))? htmlspecialchars($_POST['sku'],ENT_QUOTES, 'UTF-8'): "";
$photop = isset($_FILES['photo'])? $_FILES['photo']: "";

$array = array();

if(isset($_COOKIE['token'])){

	$user = ValidToken::decodeToken('example_key');
	
	if($user!=0){

		$idu = sqrt($user['user']);
		session_start();

		if (isset($_SESSION['idbus'])) {

			$idbus = $_SESSION['idbus'];

			if($sku !="" && $_FILES['photo']['name']!="" ){

				if($_FILES['photo']['type']=="image/jpeg" || $_FILES['photo']['type'] == "image/png"){
				
					$rutalogo    = "../../assets/images/";

				    $newnamelogo = "";

				    
				    if ($photop['size'] <= 1242880 && $photop['size'] > 1120) {

				        $newnamelogo = time().''.str_replace(' ', '', basename($photop['name']));

				        $guardado    = $rutalogo . $newnamelogo;

				        if(move_uploaded_file($_FILES['photo']['tmp_name'], $guardado)){

				        	$producto = new Picture();

							$result = $producto->uploadpictureArticle($sku, $newnamelogo);

							if(is_numeric($result)){

								if($result==1){
									$array[0]=0;
									$array[1]=$newnamelogo;

									echo json_encode($array);

								}else{

									$array[0]=1;
									$array[1]='archivo  no guardado: '.$result;
									unlink($rutalogo . $newnamelogo);
									echo json_encode($array);
								}

							}else{

								$array[0]=1;
								$array[1]='Error al guardar el archivo:'.$result;
								unlink($rutalogo . $newnamelogo);
								echo json_encode($array);
							}

				        }else{
				        	$array[0]=1;
							$array[1]='archivo no se guardo';
				        	echo json_encode($array);
				        }

				    }else{
				    	$array[0]=1;
						$array[1]='archivo muy grande';
				    	echo json_encode($array);
				    }
			    
				
				}else{
					$array[0]=1;
					$array[1]='Tipo de archivo no admitido';
				    echo json_encode($array);
				}
			}else{
				$array[0]=1;
				$array[1]='Campos vacios';
		    	echo json_encode($array);
			}

		}else{
			$array[0]=1;
			$array[1]='Inicie la session';
	    	echo json_encode($array);
		}
	}else{
		$array[0]=1;
		$array[1]='not foud this page';
    	echo json_encode($array);
	}
}else{
	$array[0]=1;
	$array[1]='not foud this page';
	echo json_encode($array);
}
