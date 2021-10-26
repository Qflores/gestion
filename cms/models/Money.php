
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Money{	

		
	private $conexion;
	private $pst;
	private $money= array();

			 
	public function __construct(){
		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();		
	}


	public function listAllMoney(){

		$query = "select id, concat(name,' ',simbol) as name from money;";		
		$res = $this->pst->query($query);

		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->money['data'][]= $list;
			}

			return $this->money;
		}else{
			return "no hay resultados";
		}
	}

}