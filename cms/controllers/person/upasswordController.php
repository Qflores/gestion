<?php

require_once dirname(__FILE__).'/../../models/Person.php';

$idper   = isset($_POST['idper']) ? htmlspecialchars($_POST['idper'], ENT_QUOTES, 'UTF-8') : "";
$oldpass = isset($_POST['passuserold']) ? htmlspecialchars($_POST['passuserold'], ENT_QUOTES, 'UTF-8') : "";
$newpass = isset($_POST['passuser1']) ? htmlspecialchars($_POST['passuser1'], ENT_QUOTES, 'UTF-8') : "";

if ($idper != "" && $oldpass != "" && $newpass != "") {

    $person = new Person();

    $result = $person->changePassworduser($idper, $oldpass, $newpass);

    if (is_numeric($result)) {
        if ($result > 0) {
            echo json_encode('1');
        } else {

            echo json_encode("No se actualizó la contraseña");
        }

    } else {
        echo json_encode($result);
    }
} else {
    echo json_encode("Los campos: nombre y usuario son Obligatorios ");
}
