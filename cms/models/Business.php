
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Business{	

		
	private $conexion;
	private $pst;
	private $busines= array();

			 
	public function __construct(){

		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}

	public function listByidBusByidUser($idu,$idb){
		$sql = "SELECT  b.id, b.name, b.logo, b.ruc, o.id as idof, o.idmoneda, o.email, o.nombre,o.iva, m.simbol FROM business as b inner join office as o  on b.id = o.idempresa inner join personoffice as p  on o.id = p.idoffice inner join money as m on o.idmoneda = m.id where p.idperson =:iduser and o.id=:idbus;";

		$stament = $this->pst->prepare($sql);

		$stament->bindParam(":iduser", $idu, PDO::PARAM_INT);
		$stament->bindParam(":idbus", $idb, PDO::PARAM_INT);
		$res = $stament->execute();
		if ($res) {

			while ($filas = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->busines[] = $filas ;
			}
			if(count($this->busines)>0)
			{
				return $this->busines;
			}else{
				return 0;
			}

		}else{
			return 0;
		}


	}

	public function listBusByPerson($idper){
		$sql = "SELECT  b.id, b.name, b.logo, b.ruc, o.id as idof, o.idmoneda, o.email, o.nombre  FROM business as b  inner join office as o  on b.id = o.idempresa   inner join personoffice as p  on o.id = p.idoffice  where p.idperson =:idper;";

		$stament = $this->pst->prepare($sql);

		$stament->bindParam(":idper", $idper, PDO::PARAM_INT);
		$res = $stament->execute();

		if ($res) {

			while ($filas = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->busines[] = $filas ;
			}
			if(count($this->busines)>0)
			{
				return $this->busines;
			}else{
				return 0;
			}

		}else{
			return 0;
		}

	}
	public function searchbyIdPerson($idper){

		$query = "SELECT o.id as ido, o.nombre,o.address, o.phone, o.timezone, o.printer, o.printerhost, o.keypos, o.iva, o.idempresa, o.idmoneda, o.file,b.id as idb, b.name as nameb, b.ruc as rucb, b.logo as logob, b.stado as stadob, o.email FROM business as b inner join office as o on b.id = o.idempresa inner join personoffice as p on o.id= p.idoffice where p.idperson =:idper;";

		$stament = $this->pst->prepare($query);
		$stament->bindParam(':idper', $idper, PDO::PARAM_INT);

		
		$res = $stament->execute();

		if($res){
			while ($list = $stament->fetch(PDO::FETCH_ASSOC)) {
				$this->busines[]= $list;
			}

			if(count($this->busines)>0){
				return $this->busines;				
			}else{
				return 0;
			}

		}else{
			return 0;
		}
	}//end select business by idPerson

	public function listForPrintByIdPerson(){
		
		session_start();

		if (isset($_SESSION['idbus']) && isset($_SESSION['ux'])){

			$user = $_SESSION['ux'];

			$iduser = $user[1];

			$idbus = $_SESSION['idbus'];
			 

			$sql = "SELECT  b.name, b.ruc,  b.logo, o.nombre, o.address, o.phone ,o.iva, o.email , m.simbol
				FROM   business as b  
				inner join  office as o  on b.id=o.idempresa
				inner join personoffice as p  on o.id = p.idoffice
				inner join money as m on o.idmoneda = m.id
				where p.idperson = :idper and o.id =:idbus limit 1;";

			
			$stament = $this->pst->prepare($sql);

			$stament->bindParam(":idper", $iduser, PDO::PARAM_STR);
			$stament->bindParam(":idbus", $idbus, PDO::PARAM_STR);
			
			$res = $stament->execute();
			
			if($res){
				while ($list = $stament->fetch(PDO::FETCH_ASSOC)) {
					$this->busines[] = $list;				
				}
				return $this->busines;
			}else{

				return 0;
			}

		}else{
			return 0;
		}

	}//end printer
	
	public function saveUpdateBusiness($idperson,$idb,$name,$ruc,$logob,$stado,$idof,$nombre,$address,$phone,$timezone,$printer,$printerhost,$keypos,$iva,$idmoneda, $email){
		$ivab = 0;
		if($iva){
			$ivab = ($iva/100);
		}

		//business
		$sqlbus ="";
		$arrayb = "";
		if($idb==0 || $idb=='0'){
			$sqlbus = "INSERT INTO business (name, ruc, logo, stado) VALUES (:name, :ruc, :logo, :stado)";
			$arrayb =array(
					'name'=>$name,
					'ruc'=>$ruc,					
					'logo'=>$logob,	
					'stado'=>$stado
				);
		}else{
			if($logob != ""){
				$sqlbus = "UPDATE business set name=:name, ruc=:ruc, logo=:logo, stado=:stado where id=:id";	
				$arrayb =array(
					'name'=>$name,
					'ruc'=>$ruc,
					'stado'=>$stado,
					'logo'=>$logob,					
					'id'=>$idb
				);
			}else{
				$sqlbus = "UPDATE business set name=:name, ruc=:ruc, stado=:stado where id=:id";
				$arrayb =array(
					'name'=>$name,
					'ruc'=>$ruc,
					'stado'=>$stado,
					'id'=>$idb
				);
			}			
		}		
		
		

		//office
		$sqlofi ="";
		$fileOf = "";
		$idempresa = "";
		$arrayo = "";

		try {
			//empesamos la transaccion
			$this->pst->beginTransaction();
			//update or inser on Business
			$statement = $this->pst->prepare($sqlbus);				
			$statement->execute($arrayb);
			$statement->closeCursor();	
			if($idb==0 || $idb=='0'){
				$idempresa = $this->pst->lastInsertId();
			}
			$afectedrow=0;

			if($statement->rowCount()){
				$afectedrow=1;
			}

			if($idof =="0" || $idof == 0){
				$sqlofi = "INSERT INTO office (nombre, address, phone, timezone, printer, printerhost, keypos, iva, idempresa, idmoneda, email)	VALUES	(:nombre, :address, :phone, :timezone, :printer, :printerhost, :keypos, :iva, :idempresa, :idmoneda,:email);";
				$arrayo =array(
					'nombre'=>$nombre,
					'address'=>$address,
					'phone'=>$phone,
					'timezone'=>$timezone,
					'printer'=>$printer,
					'printerhost'=>$printerhost,
					'keypos'=>$keypos,
					'iva'=>$ivab,
					'idempresa'=>$idempresa,
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
		
			
			//update or insert office
			$statement = $this->pst->prepare($sqlofi);			
			//ejecutamos los cambios
			$res = $statement->execute($arrayo);
			//close cursos
			$statement->closeCursor();			
			//insertamos tabla intermedia de persona y oficina
			if($idb==0 || $idb=='0'){
				$idoffice = $this->pst->lastInsertId();
				$querypo = "INSERT INTO personoffice (idoffice, idperson) VALUES (:idoffice, :idperson);";
				$statement = $this->pst->prepare($querypo);
				$statement->bindParam(":idoffice",$idoffice, PDO::PARAM_INT);
				$statement->bindParam(":idperson",$idperson, PDO::PARAM_INT);
				
				$statement->execute();

				$sqlper = "UPDATE persona SET idempresa =:idempre WHERE id =:id";
				$statement = $this->pst->prepare($sqlper);
				
				$arrayup =array(
					'idempre'=>$idoffice,
					'id'=>$idperson);
				
				$statement->execute($arrayup);
				//cierre del cursor
				$statement->closeCursor();
				if($statement->rowCount()){
					$afectedrow=1;
				}

			}
			
			if($statement->rowCount()){
				$afectedrow=1;
			}
			//todo bien, guardamos todo
			//$err = $statement->errorCode();
		    $this->pst->commit();

		    return $afectedrow;

		} catch(Exception $e) {	

			$this->pst->rollBack();

		    return "Error:".$e->getMessage();
		}

	}//end update and insert

}


