
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Size{	

		
	private $conexion;
	private $pst;
	private $product= array();

			 
	public function __construct(){

		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}


	public function listAllSize(){

		$query = "SELECT id, concat(name,' - ', simbol) as name FROM size;";		
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

	public function saveSize($name,$symbol){

		$sql = "INSERT INTO size(name,simbol) values(:name, :simbol);";

		$statement = $this->pst->prepare($sql);

		$statement->bindParam(":name", $name, PDO::PARAM_STR);
		$statement->bindParam(":simbol", $symbol, PDO::PARAM_STR);
		
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
