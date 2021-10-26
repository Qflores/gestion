<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Customer{	

		
	private $conexion;
	private $pst;
	private $customer= array();

			 
	public function __construct(){

		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}


	public function searchbyName($rucname){

		$like = '%'.$rucname.'%';

		$query = "SELECT id, names, document FROM persona where names like :name or document =:doc";
		$stament = $this->pst->prepare($query);

		$array = array(
			"name"=>$like,
			"doc"=>$rucname
		);
		$res = $stament->execute($array);

		if($res){
			while ($list = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->customer[]= $list;
			}
			return $this->customer;
		}else{
			return 0;
		}
	}

	public function listAllCustomer(){

		$query = "call sp_listperson('1');";	
		$res = $this->pst->query($query);

		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->customer['data'][]= $list;
			}

			return $this->customer;
		}else{
			return "no hay resultados";
		}
	}

	public function saveUpdateCustomer($idc, $namec, $emailc, $phone, $docc, $addressc, $cbstate){

		$query = "call sp_iucustomer($idc,'$namec','$emailc','$phone','$docc','$addressc','1', '$cbstate');";		
		$pq = $this->pst->prepare($query);
		try {
		    $res = $pq->execute(); 
		    return $res;
		} catch(Exception $e) {		    
		    return "No se pudo actualizar/guardar. Error: ".$e->getMessage();
		}

	}

	public function customerDefault(){

		$query = "SELECT id, names, document FROM persona where type=3 limit 1;";
		$res = $this->pst->query($query);
		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->customer[]= $list;
			}

			return $this->customer;
		}else{
			return 0;
		}
	}


}


