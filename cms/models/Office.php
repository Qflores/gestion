
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Office{	

		
	private $conexion;
	private $pst;
	private $office= array();
			 
	public function __construct(){
		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();			
	}


	public function searchbyI($idof){

		$query = "SELECT id, nombre, address, phone, timezone, printer, printerhost, keypos, iva, idempresa, idmoneda FROM office where id =:idof;";

		$stament = $this->pst->prepare($query);

		$stament->bindParam(":idof",$idof, PDO::PARAM_INT);
		
		$stament->execute();

		if($res){
			while ($list = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->office[]= $list;
			}
			return $this->office;
		}else{
			return 0;
		}
	}

	public function listAllOffice($idbus){

		$query = "SELECT  * FROM  office WHERE idempresa=:idem";

		$stament = $this->pst->prepare($query);
		$stament->bindParam(':idem',$idbus,PDO::PARAM_INT);
		$res = $stament->execute();
		if($res){
			while ($list = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->office[]= $list;
			}
			return $this->office;
		}else{
			return 0;
		}
	}

	public function saveUpdateOffice($idperson,$idb,$idof,$nombre,$address,$phone,$timezone,$printer,$printerhost,$keypos,$iva,$idmoneda, $email){

		$sqlofi ="";
		$arrayo ="";

		$ivab = 0;
		if($iva){
			$ivab = ($iva/100);
		}

			if($idof =="0" || $idof == 0){
				$sqlofi = "INSERT INTO office (nombre, address, phone, timezone, printer, printerhost, keypos, iva, idempresa, idmoneda, email)	VALUES	(:nombre, :address, :phone, :timezone, :printer, :printerhost, :keypos, :iva, :idempresa, :idmoneda, :email);";
				$arrayo =array(
					'nombre'=>$nombre,
					'address'=>$address,
					'phone'=>$phone,
					'timezone'=>$timezone,
					'printer'=>$printer,
					'printerhost'=>$printerhost,
					'keypos'=>$keypos,
					'iva'=>$ivab,
					'idempresa'=>$idb,
					'idmoneda'=>$idmoneda,
					'email'=>$email
				);

			}else{			
				$sqlofi = "UPDATE office SET nombre=:nombre, address=:address, phone=:phone, timezone=:timezone, printer=:printer, printerhost=:printerhost, keypos=:keypos, iva=:iva, idmoneda=:idmoneda, email=:email WHERE id=:idof";
				$arrayo =array(
					'nombre'=>$nombre,
					'address'=>$address,
					'phone'=>$phone,
					'timezone'=>$timezone,
					'printer'=>$printer,
					'printerhost'=>$printerhost,
					'keypos'=>$keypos,
					'iva'=>$ivab,
					'idmoneda'=>$idmoneda,
					'idof'=>$idof,
					'email'=>$email
				);						
			}
		
		try {
			
			$this->pst->beginTransaction();

			$statement = $this->pst->prepare($sqlofi);
			//$statement->closeCursor();
			//regitramos la oficina
		    $statement->execute($arrayo);

		    $afectedrow= 0;

			if($statement->rowCount()){
				$afectedrow=1;
			}

		    /*registramos a quien pertenece la sucursal*/
		    if($idof==0 || $idof=='0'){
				$idoffice = $this->pst->lastInsertId();
				$querypo = "INSERT INTO personoffice (idoffice, idperson) VALUES (:idoffice, :idperson);";
				$statement = $this->pst->prepare($querypo);
				$statement->bindParam(":idoffice",$idoffice, PDO::PARAM_INT);
				$statement->bindParam(":idperson",$idperson, PDO::PARAM_INT);
				
				//cierre del cursor
				//$statement->closeCursor();
				$statement->execute();				

				if($statement->rowCount()){
					$afectedrow=1;
				}
			}

		    $this->pst->commit();		    

			if($statement->rowCount()){
				$afectedrow=1;
			}

			return $afectedrow;			

		} catch(Exception $e) {
			$this->pst->rollBack();
		    return "Error:".$e->getMessage();
		}

	}

}


