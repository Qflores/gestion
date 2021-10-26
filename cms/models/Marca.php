
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Marca{	

		
	private $conexion;
	private $pst;
	private $product= array();

			 
	public function __construct(){
		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();		
	}


	public function listAllMarca(){

		$query = "select id, name from marca;";		
		$res = $this->pst->query($query);

		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->product['data'][]= $list;
			}

			return $this->product;
		}else{
			return "no hay resultados";
		}
	}

	
	public function saveMarca($name){

		$sql = "INSERT INTO marca(name) values(:name);";

		$statement = $this->pst->prepare($sql);

		$statement->bindParam(":name", $name, PDO::PARAM_STR);
		
		try {

			$statement->execute();

			$rest = 0;
			if ($statement->rowCount()) {
				$rest = 1;
			}
			
			return $rest;
			
		} catch (Exception $e) {
			return $e->getCode();
		}
	}

}
