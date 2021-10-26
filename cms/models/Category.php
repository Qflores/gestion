<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Category{	

		
	private $conexion;
	private $pst;
	private $category= array();

			 
	public function __construct(){

		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}


	public function listAllCategory(){

		$query = "select id, name from category;";		
		$res = $this->pst->query($query);

		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->category['data'][]= $list;
			}

			return $this->category;
		}else{
			return "no hay resultados de categorías";
		}
	}


	

	public function saveCategory($name){

		$sql = "INSERT INTO category(name) values(:name);";

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


?>