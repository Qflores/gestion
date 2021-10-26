<?php

session_start();

if(!isset($_SESSION['USER'])){
	echo "Iniciar session";
	header("Location: login/index.php");
}
echo "Welcome to page";
