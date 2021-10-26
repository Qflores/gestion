<?php

require_once dirname(__FILE__).'/../../models/Money.php';

	$money = new Money();
	$result = $money->listAllMoney();
	if(count($result['data'])>0){
		
		 echo json_encode($result);
	}else{

		echo json_encode("no hay resultados");
	}

