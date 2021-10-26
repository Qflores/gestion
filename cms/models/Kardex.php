
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Kardex{	

		
	private $conexion;
	private $pst;
	private $product= array();

			 
	public function __construct(){
		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();		
	}


	public function upluodFile($file){

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

	public function dowloadFile(){

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
	}//end dowload

	public function cierreKardex(){

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
	}//end 

	public function aperturaKardex(){

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
	}//end 

	public function generateKardex(){

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
	}//end 

	
	public function getKardexBysku($sku, $fecha, $idbus, $idu){

		$query = "SELECT k.*, o.description as operacion, v.name as voucher FROM kardexdetail as k 
		inner join product as p on k.id_product = p.sku 
		inner join operacion as o on k.id_operation = o.id 
		inner join voucher as v on k.id_voucher = v.id 
		where k.id_product =:sku and p.id_office= :idbus and  month(k.fecha) = :fecha;";	

		
		try {

			$statement = $this->pst->prepare($query);

			$statement->bindParam(':sku', $sku, PDO::PARAM_STR);
			$statement->bindParam(':idbus', $idbus, PDO::PARAM_STR);
			$statement->bindParam(':fecha', $fecha, PDO::PARAM_STR);

			$res = $statement->execute();
			
			if($res){

				while ($list = $statement->fetch(PDO::FETCH_ASSOC)) {
					$this->product[]= $list;
				}

				if(count($this->product)>0){
					return $this->product;
				}else{
					return 0;
				}
					
			}else{
				return 0;
			}
			
		} catch (Exception $e) {
			return $e->getCode();
		}
		
	}//end 


}