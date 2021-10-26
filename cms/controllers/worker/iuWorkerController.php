<?php

require_once dirname(__FILE__).'/../../models/Worker.php';

$idc       = (isset($_POST['idc'])) ? htmlspecialchars($_POST['idc']) : "";
$names     = (isset($_POST['names'])) ? htmlspecialchars($_POST['names'], ENT_QUOTES, 'UTF-8') : "";
$email     = (isset($_POST['email'])) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : "";
$phone     = (isset($_POST['phone'])) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : "";
$document  = (isset($_POST['docc'])) ? htmlspecialchars($_POST['docc'], ENT_QUOTES, 'UTF-8') : "";
$address   = (isset($_POST['address'])) ? htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8') : "";
$username  = (isset($_POST['username'])) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : "";
$password1 = (isset($_POST['pass1'])) ? htmlspecialchars($_POST['pass1'], ENT_QUOTES, 'UTF-8') : "";
$password2 = (isset($_POST['pass2'])) ? htmlspecialchars($_POST['pass2'], ENT_QUOTES, 'UTF-8') : "";
$state     = (isset($_POST['state'])) ? htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8') : "";
$question  = ""; //(isset($_POST['question']))? htmlspecialchars($_POST['question'],ENT_QUOTES, 'UTF-8'): "";

$userid = (isset($_POST['userid'])) ? htmlspecialchars($_POST['userid'], ENT_QUOTES, 'UTF-8') : "";

if ($idc == '0' || $idc == 0 || $userid == '0' || $userid == 0) {
    if ($username == "" || $password1 == "" || $names == "" || $email == "") {
        echo json_encode("los campos: Nombre, Usuario, Email y Contraseña son obligatorios");
        exit();
    }

    if ($password1 != $password2) {
        echo json_encode("la constraseña no coincide: min 4 caracteres mayus,  minus y números");
        exit();
    }

}

if ($idc != "" && $names != "" && $state != "" && $email) {

    $worker = new Worker();

    $result = $worker->saveUpdateWorker($idc, $names, $email, $phone, $document, $address, $state, $username, $password1, $question, $userid);

    if ($result) {
        echo json_encode($result);
    } else {

        echo json_encode($result);
    }
} else {
    echo json_encode("Los campos: nombre y usuario son Obligatorios ");
}
