<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Purchase{	

		
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

	public function listAllProduct(){

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

	public function saveOrder($product, $idvoucher, $idopera, $idworker, $idsupplier, $nfact){
		
		date_default_timezone_set('America/Lima');
		$fecha = date('Y-m-d H:i:s');
		$dia = date('Y-m-d');

		$sqlorder = "INSERT INTO purchase (id_supplier,f_register,id_worker,documento) Values (:idsupplier, :fecha, :idworker,:nfact)";
		$orderarray = array(
			"idsupplier" => $idsupplier, 
			"fecha" => $fecha, 
			"idworker" => $idworker,
			"nfact" => $nfact
		);

		$sqlorderdetail = "INSERT INTO purchasedetail (price, quantity, discount, id_purchase, id_product,impuesto) values (:price, :canty, :discount, :idorder, :idproduct, :impuesto);";
		$sms = "";
		try {
			//start transactions on order header and detailorder
			$this->pst->beginTransaction();
			// Insert the order header 
			$statement = $this->pst->prepare($sqlorder);
			// insert into table  orderheader
			$res = $statement->execute($orderarray);
			$idheader = $this->pst->lastInsertId();

			$sms = " guardar el ";

			for ($i=0; $i <count($product) ; $i++) { 

				$sku = $product[$i]['sku'];
				$precio = $product[$i]['punitario'];
				$cantidad = $product[$i]['cantidad'];
				$impuesto = $product[$i]['impuesto'];
				$sikardex = $product[$i]['stock'];

				$detailarray= array(
					"price"=>$precio, 
					"canty"=>$cantidad, 
					"discount"=> 0, 
					"idorder"=>$idheader, 
					"idproduct"=>$sku,	
					"impuesto"=>$impuesto	
				);

				//insert order detail
				$statement = $this->pst->prepare($sqlorderdetail);
				//execute order detail
				$res = $statement->execute($detailarray);
				$sms = $sms." detalle";

				//pasamos a registra el kardex
				if($sikardex ==1 || $sikardex =='1'){

					$selectkardex = "SELECT * FROM kardexdetail where id_product =:idsku1 and id=(select max(id) from kardexdetail where id_product=:idsku2) limit 1;";

					$prepare = $this->pst->prepare($selectkardex);
					$prepare->bindParam(':idsku1',$sku,PDO::PARAM_STR);
					$prepare->bindParam(':idsku2',$sku,PDO::PARAM_STR);
					$prepare->execute();

					$existe = $prepare->rowCount();

					
					if($existe>0){
					
						while ($fila =$prepare->fetch(PDO::FETCH_ASSOC)) {
							$priceold = $fila['prom_unit'];
							$cantyold = $fila['prom_canty'];
							$oldTotal = $fila['prom_total'];

							$precioingresado =0;

							$igv = round(1+$impuesto,2);

							if ($impuesto>0) {
								$precioingresado=round($precio/$igv,4);
							}else{
								 $precioingresado = $precio;
							}

							$buytotal =round($cantidad*$precioingresado,4);

							$insertkardex = "INSERT INTO kardexdetail(fecha,num_fac,id_voucher,id_product,buy_canty, buy_unit, buy_total, prom_canty,prom_unit,prom_total,id_operation) 
							VALUES (:fecha,:num_fac,:id_voucher,:id_product,:buy_canty, :buy_unit, :buy_total,:prom_canty,:prom_unit,:prom_total,:id_operation);";

							$idoper= 2;
							
							$newcanty = round($cantidad+$cantyold,4);
							$newpromtotal = round($oldTotal+$buytotal,4);
							$newprice =round($newpromtotal/$newcanty,4);
													
							$prekardex = $this->pst->prepare($insertkardex);
							$prekardex->bindParam(':fecha', $dia ,PDO::PARAM_STR);
							$prekardex->bindParam(':num_fac', $nfact ,PDO::PARAM_STR);
							$prekardex->bindParam(':id_voucher', $idvoucher ,PDO::PARAM_STR);
							$prekardex->bindParam(':id_operation', $idoper ,PDO::PARAM_STR);
							$prekardex->bindParam(':id_product', $sku ,PDO::PARAM_STR);

							$prekardex->bindParam(':buy_canty', $cantidad , PDO::PARAM_STR);
							$prekardex->bindParam(':buy_unit', $precioingresado , PDO::PARAM_STR);
							$prekardex->bindParam(':buy_total', $buytotal , PDO::PARAM_STR);

							$prekardex->bindParam(':prom_canty', $newcanty ,PDO::PARAM_STR);
							$prekardex->bindParam(':prom_unit', $newprice ,PDO::PARAM_STR);
							$prekardex->bindParam(':prom_total', $newpromtotal ,PDO::PARAM_STR);
							
							$prekardex->execute();

						}

					}
				}

			}

			 $this->pst->commit();

			 return $res;
			
		} catch (Exception $e) {

			$this->pst->rollBack();
		    return "No se pudo ".$sms.", Error: ".$e->getMessage();
			
		}

	}//end save purchase

	public  function listByFilterPurchase($finicio, $ffin, $nombres, $idbus){

		$sql = "SELECT 
		 	h.id,
		 	h.f_register as fecha,
		 	h.documento,
		 	s.name as proveedor,
		 	s.phone,
		 	s.id as idsupplier,
		 	w.names as cajero,
		 	h.id_worker as idcajero,
		 	ROUND(sum(d.price*d.quantity), 2) as monto 
			FROM purchase as h
			inner join supplier as s on h.id_supplier = s.id
			inner join persona as w	on h.id_worker = w.id
			inner join purchasedetail as d on h.id = d.id_purchase
			where h.idbus = :idbus and  h.f_register between :inicio and :fin and  s.name like :name or  w.names like :namew
			group by  w.names, h.id, h.f_register, h.documento, s.name, s.phone, s.id,h.id_worker ;";
			

		$likename = $nombres."%";

		$statement = $this->pst->prepare($sql);

		$statement->bindParam(":inicio", $finicio, PDO::PARAM_STR);
		$statement->bindParam(":fin", $ffin, PDO::PARAM_STR);
		$statement->bindParam(":name", $likename, PDO::PARAM_STR);
		$statement->bindParam(":namew", $likename, PDO::PARAM_STR);
		$statement->bindParam(":idbus", $idbus, PDO::PARAM_STR);

		$res = $statement->execute();
		
		if($res){

			while ($fila= $statement->fetch(PDO::FETCH_ASSOC)) {

				$this->product[] = $fila;
			}

			if(count($this->product)>0){

				return $this->product;

			}else{

				return 0;
			}

		}else{
			return 0;
		}

	}//end lista header purchase

	public  function listdetailPurchase($iddetail){

		$sql = "call sp_listdetailpurchase(:id);";
		
		$statement = $this->pst->prepare($sql);
		$statement->bindParam(":id", $iddetail, PDO::PARAM_INT);
		$res = $statement->execute();
		
		
		if($res){

			while ($fila= $statement->fetch(PDO::FETCH_ASSOC)) {

				$this->product[] = $fila;
			}

			if(count($this->product)>0){

				return $this->product;

			}else{

				return 0;
			}

		}else{
			return 0;
		}
	}
}
