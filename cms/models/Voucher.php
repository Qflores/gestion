
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Voucher{

	private $conexion;
	private $pst;
	private $voucher= array();
			 
	public function __construct(){
		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();			
	}


	public function listAllvoucher(){

		$query = "SELECT id, name FROM voucher;";

		$stament = $this->pst->prepare($query);		
		$res = $stament->execute();

		if($res){
			
			while ($list = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->voucher[]= $list;
			}
			if (count($this->voucher)){
				return $this->voucher;
			}else{
				return 0;
			}
			
		}else{
			return 0;
		}
	}

}





