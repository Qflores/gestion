
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Supplier{	

		
	private $conexion;
	private $pst;
	private $supplier= array();

			 
	public function __construct(){

		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}

	

	public function searchBynameRuc($rucname){

		$like = '%'.$rucname.'%';

		$query = "SELECT id, name, document FROM supplier where name like :names or document =:doc;";
		$stament = $this->pst->prepare($query);

		$array = array(
			"names"=>$like,
			"doc"=>$rucname
		);
		$res = $stament->execute($array);

		if($res){
			while ($list = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->supplier[]= $list;
			}
			return $this->supplier;
		}else{
			return 0;
		}
	}


	public function listAllSupplier(){

		$query = "call sp_listsupplier();";	
		$res = $this->pst->query($query);

		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->supplier['data'][]= $list;
			}

			return $this->supplier;
		}else{
			return "no hay resultados";
		}
	}

	public function saveUpdateSupplier($id, $namep, $addressp, $tipodoc, $nump, $phonep, $emailp, $serp, $idmoney){
		
		$query = "call sp_iusupplier($id, '$namep', '$addressp', '$tipodoc', '$nump', '$phonep', '$emailp', '$serp', $idmoney);";
		$pq = $this->pst->prepare($query);

		/*$pq->bindParam(':skua', $skua, PDO::PARAM_STR);
		$pq->bindParam(':namea', $namea, PDO::PARAM_STR );
		$pq->bindParam(':pricea', $pricea, PDO::PARAM_STR);
		$pq->bindParam(':cantya', $cantya, PDO::PARAM_STR);
		$pq->bindParam(':cbcat', $cbcat, PDO::PARAM_INT);
		$pq->bindParam(':cbsize', $cbsize, PDO::PARAM_INT);
		$pq->bindParam(':cbmarca', $cbmarca, PDO::PARAM_INT);
		$pq->bindParam(':cbstate', $cbstate, PDO::PARAM_INT);*/
		
		try {
		    $res = $pq->execute();
		    return $res;
		} catch(Exception $e) {
		    
		    return "No se pudo actualizar/guardar. Error: ".$e->getMessage();
		}
	}
}
