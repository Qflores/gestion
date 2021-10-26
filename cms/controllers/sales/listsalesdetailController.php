
<?php

require_once dirname(__FILE__).'/../../models/Sales.php';


	$idsale = 	isset($_POST['idsale'])? htmlspecialchars($_POST['idsale'],ENT_QUOTES, "UTF-8") :"";
	
	
	$array = array();

	if ($idsale != "") {	

		$purchase = new Sales();
		$res = $purchase->listDetailSales($idsale);

		if(count($res)>0){			
			echo json_encode($res);
		}else{

			$array[0]="2";
			$array[1]="Error: ".$res;
			echo json_encode($array);

		}

	}else{
		$array[0]="0";
		$array[1]="Campos vacios";
		echo json_encode($array);
	}

