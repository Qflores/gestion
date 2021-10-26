<?php

require_once dirname(__FILE__).'/../../models/Person.php';

$idper    = isset($_POST['idper']) ? htmlspecialchars($_POST['idper'], ENT_QUOTES, 'UTF-8') : "";
$namep    = isset($_POST['namep']) ? htmlspecialchars($_POST['namep'], ENT_QUOTES, 'UTF-8') : "";
$emailp   = isset($_POST['emailp']) ? htmlspecialchars($_POST['emailp'], ENT_QUOTES, 'UTF-8') : "";
$phonep   = isset($_POST['phonep']) ? htmlspecialchars($_POST['phonep'], ENT_QUOTES, 'UTF-8') : "";
$docp     = isset($_POST['docp']) ? htmlspecialchars($_POST['docp'], ENT_QUOTES, 'UTF-8') : "";
$addressp = isset($_POST['addressp']) ? htmlspecialchars($_POST['addressp'], ENT_QUOTES, 'UTF-8') : "";
$photop   = isset($_FILES['photo']) ? $_FILES['photo'] : "";

if ($idper != "" && $namep != "" && $emailp != "" && $phonep && $addressp != "") {

    $oldimg = isset($_POST['photoold']) ? htmlspecialchars($_POST['photoold'], ENT_QUOTES, 'UTF-8') : "";

    $rutalogo    = "../../assets/images/";
    $newnamelogo = "";

    if ($photop != "") {
        if ($photop['size'] <= 1242880 && $photop['size'] > 1120) {
            if ($oldimg != "") {
                unlink($rutalogo . $oldimg);
            }
        }

        $newnamelogo = $idper . $docp . '' . str_replace(' ', '', basename($photop['name']));
        $guardado    = $rutalogo . $newnamelogo;

        move_uploaded_file($_FILES['photo']['tmp_name'], $guardado);
    }

    $person = new Person();

    $result = $person->updatePerson($idper, $namep, $emailp, $phonep, $docp, $addressp, $newnamelogo);

    if ($result != 0) {
        echo json_encode('1');
    } else {
        echo json_encode($result);
    }
} else {
    echo json_encode("Los campos: nombre y usuario son Obligatorios ");
}
