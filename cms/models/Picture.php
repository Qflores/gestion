
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Picture{	

		
	private $conexion;
	private $pst;
	private $picture= array();

			 
	public function __construct(){

		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}

	public function deletePictureArticle($idpic){

		$query = "DELETE FROM picture WHERE id = $idpic;";		

		$stament = $this->pst->prepare($query);

		$stament->execute();

		if($stament->rowCount()){

			return 1;

		}else{

			return 0;
		}
	}


	

	public function getAllPicture($sku){

		$query = "SELECT id, id_product, path FROM picture where id_product= $sku ;";		
		$res = $this->pst->query($query);

		if($res){

			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {

				$this->picture[]= $list;
			}
			if(count($this->picture)){

				return $this->picture;

			}else{
				return 0;
			}

		}else{
			return 0;
		}
	}


	public function uploadpictureArticle($sku,$img){

		$sql = "INSERT INTO picture (id_product,path) VALUES (:sku, :img);";

		$stament = $this->pst->prepare($sql);

		$stament->bindParam(":sku", $sku, PDO::PARAM_STR);
		$stament->bindParam(":img", $img, PDO::PARAM_STR);
		

		try {

			$stament->execute();

			

			if ($stament->rowCount()) {
				
				return 1;

			}else{
				return 0;
			}
			$stament->clouseCursor();

		} catch (Exception $e) {

			return 	$e->getMessage().' '.$e->getCode();

		}
	}
}

