
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Product{
		
	private $conexion;
	private $pst;
	private $product= array();
	public function __construct(){
		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}

	public function getInfoProduct($sku){
		
		$sql = "SELECT a.*, m.name as marca, concat(z.name, ' - ', z.simbol ) as unidad, c.name as categoria, o.nombre as office , b.name as empresa 
		from product as a
		inner join marca as m on a.id_marca = m.id
		inner join size as z on a.id_size = z.id
		inner join category as c on a.id_category = c.id
		inner join office as o on a.id_office = o.id
		inner join business as b on o.idempresa = b.id
		where a.sku =:skup; ";

		$statement = $this->pst->prepare($sql);

		$statement->bindParam(':skup', $sku, PDO::PARAM_STR);
		
		try {
			
			$statement->execute();

			$res = $statement->rowCount();

			if ($res>0) {

				while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
					$this->product[] = $fila;
				}

				return $this->product;

			}else{
				return 0;
			}

			
		} catch (Exception $e) {

			return "Error:".$e->getCode();
			
		}
		


	}


	public function addProdfast($sku, $name, $price, $canty, $idbus, $iva){

		$sqlsize = "SELECT id FROM size  order by id asc limit 1;";
		$sizeres = $this->pst->prepare($sqlsize);	
		$sizeres->execute();

		$idsize = "";
		if ($sizeres) {
			while($list = $sizeres->fetch(PDO::FETCH_ASSOC)){
				$idsize = $list['id'];
			}
		}

		$sqlcategory = "SELECT id FROM category order by id asc limit 1;";
		
		$cateres = $this->pst->prepare($sqlcategory);
		$cateres->execute();

		$idcategory = "";

		if ($cateres) {
			while($list = $cateres->fetch(PDO::FETCH_ASSOC)){
				$idcategory = $list['id'];
			}
		}

		$sqlmarca = "SELECT id FROM marca order by id asc limit 1;";
		$marcares = $this->pst->prepare($sqlmarca);
		$marcares->execute();

		$idmarca = "";
		if ($marcares) {
			while($list =$marcares->fetch(PDO::FETCH_ASSOC)){
				$idmarca = $list['id'];
			}
		}


		$sql = "INSERT INTO product(sku, name, price, pricebuy,size, quantity, iva, isc, min,max,state,id_marca,id_size,id_category,id_office, stock) VALUES (:sku, :name, :price, :pricebuy, :size, :quantity, :iva, :isc, :min, :max, :state, :id_marca, :id_size, :id_category, :id_office, :stock);";
		
		$statement = $this->pst->prepare($sql);
		$stado = '1';
		$priceby = '0';
		$size = "0";
		$min = "0";
		$max = "0";
		$ics = "0";
		$stock = "0";

		$statement->bindParam(':sku', $sku, PDO::PARAM_STR);
		$statement->bindParam(':name', $name, PDO::PARAM_STR);
		$statement->bindParam(':price', $price, PDO::PARAM_STR);
		$statement->bindParam(':quantity', $canty, PDO::PARAM_STR);
		$statement->bindParam(':iva', $iva, PDO::PARAM_STR);
		$statement->bindParam(':state',$stado, PDO::PARAM_STR);
		$statement->bindParam(':id_office', $idbus, PDO::PARAM_STR);
		$statement->bindParam(':id_marca', $idmarca, PDO::PARAM_STR);
		$statement->bindParam(':id_size', $idsize, PDO::PARAM_STR);
		$statement->bindParam(':id_category', $idcategory, PDO::PARAM_STR);
		$statement->bindParam(':pricebuy',$pricebuy, PDO::PARAM_NULL);
		$statement->bindParam(':size',$size, PDO::PARAM_NULL);
		$statement->bindParam(':isc',$ics, PDO::PARAM_NULL);
		$statement->bindParam(':min',$min, PDO::PARAM_NULL);
		$statement->bindParam(':max',$max, PDO::PARAM_NULL);
		$statement->bindParam(':stock',$stock, PDO::PARAM_NULL);

		$statement->execute();
		$resquest = 0;

		if($statement->rowCount()){
			$resquest= 1;
		}
		return $resquest;
	}

	public function searchByIdName($sku,$idbus){
		
		if(is_numeric($sku)){
			$sql = "SELECT sku, name, price, iva, ifnull(stock, 0) as stock FROM product where id_office=:idbus and state=1 and sku =:sku limit 10;";
		}else{
			$sql = "SELECT sku, name, price, iva, ifnull(stock, 0) as stock FROM product where id_office=:idbus and state=1 and name LIKE :name limit 10;";	
		}
		

		$statement = $this->pst->prepare($sql);
		if(is_numeric($sku)){
			$statement->bindParam(":sku", $sku, PDO::PARAM_STR);
		}else{
			$namelike = '%'.$sku.'%';
			$statement->bindParam(":name", $namelike, PDO::PARAM_STR);
		}
		
		$statement->bindParam(":idbus", $idbus, PDO::PARAM_INT);
		$res =$statement->execute();
		
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

	}

	public function listAllProductProd($idu, $idbus, $sku, $long){
		$skuname = "";
		$limit = ";";
		if($long !=-1 ||$long!='-1'){
			$limit = " limit $long;";
		}

		if(is_numeric($sku)){
			$skuname = " a.sku=$sku ".$limit;
		}else{
			$names = "'%".$sku."%' ".$limit;
			$skuname = " a.name like ".$names;
		}

		$query = "SELECT
				a.sku, 
			    a.name as article, 
			    a.price, 
			    a.id_category as id_cat,
			    c.name as category, 
			    a.id_size as id_unidad, 
			    t.name as unidad, 
			    a.id_marca as id_marca,
			    m.name as marca, 
			    a.quantity,
			    a.state,
			    a.pricebuy,
			    a.size,
			    a.max,
			    a.min,
			    a.id_office,
			    a.iva,
			    IFNULL(a.stock,0) as stock,
			    (a.isc*100) as isc
				FROM product as a
				inner join category as c on a.id_category = c.id
				inner join size as t on a.id_size=t.id
				inner join marca as m on a.id_marca=m.id
				inner join office as o on a.id_office = o.id
				inner join personoffice as p on o.id =p.idoffice
				where a.id_office =$idbus and p.idperson=$idu and ".$skuname;

		$res = $this->pst->query($query);

		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$this->product['data'][]= $list;
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

	public function selectInfoBusiness($idbus){
			
		$query = "SELECT  o.iva FROM office as o  where o.id=$idbus;";
		
		$res = $this->pst->query($query);
		
		$ivabus = "";


		if($res){
			while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
				$ivabus= $list['iva'];
			}
		}

		return $ivabus;


	}

	public function saveUpdateArticle($skua, $namea, $pricea, $cantya, $cbcat, $cbsize, $cbmarca,$cbstate, $nuevo, $priceab, $impa, $isca, $mina, $maxa, $sizea, $idbus,$stock){

		$query = "call sp_iuarticle(:skua, :namea, :pricea, :cantya, :cbcat, :cbsize, :cbmarca, :cbstate, :nuevo, :priceab, :impa, :isca, :mina, :maxa, :sizea,:idoffice, :stock);";
		

		try {

			$this->pst->beginTransaction();

			$statement = $this->pst->prepare($query);
		
			$iscn = 0;

			if($isca > 0 || $isca !=""){
				$iscn = 1*($isca/100);
			}

			
			if($impa=='1' || $impa==1){
				$ivabus = $this->selectInfoBusiness($idbus);
			}else{
				$ivabus =0;
			}
			

			$statement->bindParam(':skua', $skua, PDO::PARAM_STR);
			$statement->bindParam(':namea', $namea, PDO::PARAM_STR);
			$statement->bindParam(':pricea', $pricea, PDO::PARAM_STR);
			$statement->bindParam(':cantya', $cantya, ($cantya=="") ? PDO::PARAM_NULL : PDO::PARAM_STR);
			$statement->bindParam(':cbcat', $cbcat, PDO::PARAM_STR);
			$statement->bindParam(':cbsize', $cbsize, PDO::PARAM_INT);
			$statement->bindParam(':cbmarca', $cbmarca, PDO::PARAM_INT);
			$statement->bindParam(':cbstate', $cbstate, PDO::PARAM_INT);
			$statement->bindParam(':nuevo', $nuevo, PDO::PARAM_STR);

			$statement->bindParam(':priceab', $priceab, ($priceab=="") ? PDO::PARAM_NULL : PDO::PARAM_STR);
			$statement->bindParam(':impa', $ivabus, PDO::PARAM_STR);
			$statement->bindParam(':isca', $iscn, ($iscn =="0") ? PDO::PARAM_NULL : PDO::PARAM_STR);
			$statement->bindParam(':mina', $mina, ($mina =="") ?  PDO::PARAM_NULL : PDO::PARAM_STR);
			$statement->bindParam(':maxa', $maxa, ($maxa=="") ?  PDO::PARAM_NULL : PDO::PARAM_STR);
			$statement->bindParam(':sizea', $sizea, ($sizea=="") ?  PDO::PARAM_NULL : PDO::PARAM_STR);
			$statement->bindParam(':idoffice', $idbus, PDO::PARAM_INT);
			$statement->bindParam(':stock', $stock, ($stock=="0" || $stock==0) ?  PDO::PARAM_NULL : PDO::PARAM_STR);
		
			$res = 0;

			
			$statement->execute();
			$statement->closeCursor();

				

			if($statement->rowCount()){
				$res = 1;

				$floprice  = floatval($priceab);
				$flocanty  = floatval($cantya);

				
				$existe = 1;

				if($stock ==1 || $stock =='1'){

					$selectkardex = "SELECT * FROM kardexdetail where id_product =:idsku1 and id=(select max(id) from kardexdetail where id_product=:idsku2) limit 1;";

					$prepare = $this->pst->prepare($selectkardex);
					$prepare->bindParam(':idsku1',$skua,PDO::PARAM_STR);
					$prepare->bindParam(':idsku2',$skua,PDO::PARAM_STR);
					$prepare->execute();

					$existe = $prepare->rowCount();

				
				}

								

				if($stock==1 && $floprice >0 &&  $flocanty >0 && $existe==0) {

					$operacion = "SELECT id FROM operacion where code = '16';";
					$statement = $this->pst->prepare($operacion);
					$statement->execute();
					$idoperacion = "";
					while ($fila =$statement->fetch(PDO::FETCH_ASSOC)) {
						$idoperacion = $fila['id'];
					}
					$statement->closeCursor();
					
					$voucher = "SELECT id FROM voucher where code = '00';";
					$statement = $this->pst->prepare($voucher);
					$statement->execute();
					$idvoucher = "";
					while ($fila =$statement->fetch(PDO::FETCH_ASSOC)) {
						$idvoucher = $fila['id'];
					}
					$statement->closeCursor();

					date_default_timezone_set('America/Lima');
					$fecha = date('Y-m-d');

					$kardex = "INSERT INTO kardexdetail (fecha,id_voucher,id_product,prom_canty,prom_unit,prom_total,id_operation) 
					VALUES(:fecha,:id_voucher,:id_product,:prom_canty,:prom_unit,:prom_total,:id_operation);";
					$statement = $this->pst->prepare($kardex);
					
					$pricebase = round(($priceab/(1+$ivabus)),4);

					$promtotal = $cantya*$pricebase;

					$statement->bindParam(':fecha', $fecha, PDO::PARAM_STR);
					$statement->bindParam(':id_voucher', $idvoucher, PDO::PARAM_INT);
					$statement->bindParam(':id_product', $skua, PDO::PARAM_STR);
					$statement->bindParam(':prom_canty', $cantya, PDO::PARAM_STR);
					$statement->bindParam(':prom_unit', $pricebase, PDO::PARAM_STR);
					$statement->bindParam(':prom_total', $promtotal, PDO::PARAM_STR);
					$statement->bindParam(':id_operation', $idoperacion, PDO::PARAM_INT);
					$statement->execute();
					//$statement->closeCursor();
					if($statement->rowCount()){
						$res = 1;
					}
				}
			}

			$this->pst->commit();
			
		    return $res;

		}catch(Exception $e) {
		    $this->pst->rollBack();
		    $sms= "";
		    if($e->getCode()==23000){
		    	$sms = "El producto ya existe";
		    }else{
		    	$sms = $e->getMessage();
		    }
		    return " Error: ".$sms;
		}
	}
}
