
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';


class Sales{	

		
	private $conexion;
	private $pst;
	private $product= array();

			 
	public function __construct(){

		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}

	public function searchById($sku){
		$query = "SELECT sku, name FROM product where sku ='$sku';";	
		$res = $this->pst->query($query);		
		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->product[]= $list;
			}
			return $this->product;
		}else{
			return 0;
		}

	}

	public function saleById($id){

		$query = "call sp_salesbyid($id)";

		$res = $this->pst->query($query);

		//$this->pst->Close();		
		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->product[]= $list;
			}
			return $this->product;
		}else{
			return 0;
		}

	}

	public function listAllSales(){

		$query = "call sp_listarticle();";	
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

	public function saveSales($detallesales, $nfact, $discount, $idbus, $idworker, $idcustomer,$idvoucher,$state){

		date_default_timezone_set('America/Lima');
		$fecha = date('Y-m-d H:i:s');
		$dia = date('Y-m-d');

		$sqlsales = "INSERT INTO salesheader (code, discount, f_sales,state,idbus, id_user, id_customer) VALUES (:code, :discount, :fecha, :state, :idbus, :iduser, :idcustomer);";
		
		$salesarray = array(
			"code"=>$nfact,
			"discount"=>$discount,
			"fecha"=>$fecha,			
			"state"=>$state,
			"idbus"=>$idbus,
			"iduser"=>$idworker,
			"idcustomer"=>$idcustomer
		);
		
		$sqldetail = "INSERT INTO salesdetail (canty, price, impuesto, bonificacion,descuento, state, id_orderheader, id_product) VALUES (:canty, :price,:impuesto, :bonificacion, :descuento,:state, :idorderheader, :idproduct)";

		$sms = " ";
		
		try {
			//start transactions on order header and detailorder
			$this->pst->beginTransaction();
			// Insert the order header 
			$statement = $this->pst->prepare($sqlsales);
			// insert into table  orderheader
			$statement->execute($salesarray);
			$idheader = $this->pst->lastInsertId();

			$afectedrow =0;
			if($statement->rowCount()){
				$afectedrow = 1;
			}

			for ($i=0; $i <count($detallesales) ; $i++) {
				$cantidad = $detallesales[$i]['cantidad'];				
				$preciou = $detallesales[$i]['punitario'];
				$impuesto = $detallesales[$i]['impuesto'];
				$bonificacion = $detallesales[$i]['bonificacion'];
				$descuento = $detallesales[$i]['descuento'];
				$sku = $detallesales[$i]['sku'];
				$sikardex = $detallesales[$i]['stock'];

				$detailarray= array(
					"canty"=>$cantidad,
					"price"=>$preciou,
					"impuesto"=> $impuesto,
					"bonificacion"=> $bonificacion,
					"descuento"=> $descuento,
					"state"=> 1,
					"idorderheader"=>$idheader,
					"idproduct"=>$sku
				);
				//insert order detail
				$statement = $this->pst->prepare($sqldetail);
				//execute order detail
				$statement->execute($detailarray);

				//register kardex
				//
				if($sikardex ==1 || $sikardex =='1'){

					$selectkardex = "SELECT * FROM kardexdetail where id_product =:idsku1 and id=(select max(id) from kardexdetail where id_product=:idsku2) limit 1;";

					$prepare = $this->pst->prepare($selectkardex);
					$prepare->bindParam(':idsku1',$sku,PDO::PARAM_STR);
					$prepare->bindParam(':idsku2',$sku,PDO::PARAM_STR);
					$prepare->execute();

					while ($fila =$prepare->fetch(PDO::FETCH_ASSOC)) {

						$priceold = $fila['prom_unit'];
						$cantyold = $fila['prom_canty'];
						$oldTotal = $fila['prom_total'];

						$newcanty =  round($cantyold-$cantidad,4);						
						$salestotal = round($cantidad*$priceold,4);

						$newpromtotal = $oldTotal-$salestotal;

						$inserkardex = "INSERT INTO kardexdetail(fecha,num_fac,id_voucher,id_product, sales_canty,sales_unit,sales_total,prom_canty,prom_unit,prom_total,id_operation) 
						VALUES (:fecha,:num_fac,:id_voucher,:id_product,:sales_canty,:sales_unit,:sales_total,:prom_canty,:prom_unit,:prom_total,:id_operation);";

						$idoper= 1;
						//$idvou= 1;
						
						$prekardex = $this->pst->prepare($inserkardex);
						$prekardex->bindParam(':fecha', $dia ,PDO::PARAM_STR);
						$prekardex->bindParam(':num_fac', $nfact ,PDO::PARAM_STR);
						$prekardex->bindParam(':id_voucher', $idvoucher ,PDO::PARAM_STR);
						$prekardex->bindParam(':id_product', $sku ,PDO::PARAM_STR);
						$prekardex->bindParam(':sales_canty', $cantidad ,PDO::PARAM_STR);
						$prekardex->bindParam(':sales_unit', $priceold ,PDO::PARAM_STR);
						$prekardex->bindParam(':sales_total', $salestotal ,PDO::PARAM_STR);
						$prekardex->bindParam(':prom_canty', $newcanty ,PDO::PARAM_STR);
						$prekardex->bindParam(':prom_unit', $priceold ,PDO::PARAM_STR);
						$prekardex->bindParam(':prom_total', $newpromtotal ,PDO::PARAM_STR);
						$prekardex->bindParam(':id_operation', $idoper ,PDO::PARAM_STR);
						
						$prekardex->execute();
						
					}//end while
				}//end if kardex
			}//end detalle

			if($statement->rowCount()){
				$afectedrow = 1;
			}

			 $this->pst->commit();
			 
			 return $idheader;
			
		} catch (Exception $e) {
			$this->pst->rollBack();

		    return "Error:".$e->getMessage();
			
		}

	}//end function register ventas

	public function listSales($names, $fincio, $ffin, $idbus, $state){

		//$sql = "call sp_listsales(:names, :finicio, :ffin, :idbus, :state);";
		$sql = "SELECT 
			s.id,
			s.code,
			s.f_sales as fecha, 
			s.state,
			c.names as customer,
			c.document,
			c.email,
			c.id as idcustomer,
			u.names as users,
			u.id as iduser
			FROM salesheader as s
			inner join persona as c
			on s.id_customer = c.id
			inner join persona as u
			on s.id_user = u.id
			where s.idbus = :idbus and  s.state =:state and s.f_sales BETWEEN  :finicio and  :ffin 
			and c.names like :names or u.names like :names  order by s.id desc";

		$namelike = '%'.$names.'%';
		$statement =  $this->pst->prepare($sql);		
		$statement->bindParam(":names", $namelike,PDO::PARAM_STR);
		$statement->bindParam(":finicio", $fincio,PDO::PARAM_STR);
		$statement->bindParam(":ffin", $ffin,PDO::PARAM_STR);	
		$statement->bindParam(":idbus", $idbus,PDO::PARAM_INT);	
		$statement->bindParam(":state", $state,PDO::PARAM_STR);	
		
		$res=$statement->execute();
		
		if($res){
			while ($list = $statement->fetch(PDO::FETCH_ASSOC)) {
				$this->product[]= $list;			
			}
			if (count($this->product)>0) {
				return $this->product;
			}else{
				return 0;
			}

		}else{
			return 0;
		}
	}//end list


	public function listDetailSales($idsales){

		$sql = "call sp_listsalesdetail(:idsale);";

		$statement =  $this->pst->prepare($sql);		
		$statement->bindParam(":idsale", $idsales, PDO::PARAM_INT);
		$res=$statement->execute();

		$array=array();
		if($res){
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$array[] =$row;
			}
			return $array;

		}else{
			return 0;
		}
	}
}
