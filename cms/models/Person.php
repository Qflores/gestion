
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Person
{

    private $conexion;
    private $pst;
    private $person = array();

    public function __construct()
    {

        $this->conexion = new Conexion();
        $this->pst      = $this->conexion->getConectar();

    }

    public function payAcountCustomer($idus, $pass, $idhead)
    {

        $query     = "SELECT p.names, u.password FROM persona as p inner join users as u on p.id = u.id_person WHERE p.id=:idus;";
        $statement = $this->pst->prepare($query);
        $statement->bindParam(":idus", $idus, PDO::PARAM_INT);

        $res    = $statement->execute();
        $update = 0;
        if ($res) {

            try {

                while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
                    if (password_verify($pass, $fila['password'])) {

                        date_default_timezone_set('America/Lima');
                        $fecha = date('Y-m-d H:i:s');

                        $sql = "UPDATE salesheader set f_pay =:fecha, state='3',id_user=:idus where id=:idhead;";

                        $this->pst->beginTransaction();

                        $stament = $this->pst->prepare($sql);
                        $stament->bindParam(":fecha", $fecha, PDO::PARAM_STR);
                        $stament->bindParam(":idhead", $idhead, PDO::PARAM_INT);
                        $stament->bindParam(":idus", $idus, PDO::PARAM_INT);

                        $res = $stament->execute();

                        if ($stament->rowCount()) {
                            $update = 1;
                        }

                        $this->pst->commit();
                    }
                }
                return $update;

            } catch (Exception $e) {
                $this->pst->rollBack();
                return "Error: " . $e->getMessage();
            }

        }

    }

    public function listUsers()
    {

        $query = "select * from person;";
        $res   = $this->pst->query($query);

        if ($res) {
            while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
                $this->person[] = $list;
            }

            return $this->person;
        } else {
            return "no hay resultados";
        }
    }

    public function updatePerson($idper, $namep, $emailp, $phonep, $docp, $addressp, $foto)
    {

        if ($foto != "") {
            $sql = "UPDATE persona SET names =:names, email =:email, phone =:phone, document =:document, address =:address, foto =:foto WHERE id=:idper";
        } else {
            $sql = "UPDATE persona SET names =:names, email =:email, phone =:phone, document =:document, address =:address WHERE id=:idper";
        }

        try {
            $statement = $this->pst->prepare($sql);

            $statement->bindParam(':names', $namep, PDO::PARAM_STR);
            $statement->bindParam(':email', $emailp, PDO::PARAM_STR);
            $statement->bindParam(':phone', $phonep, PDO::PARAM_STR);
            $statement->bindParam(':document', $docp, PDO::PARAM_STR);
            $statement->bindParam(':address', $addressp, PDO::PARAM_STR);
            $statement->bindParam(':idper', $idper, PDO::PARAM_INT);
            if ($foto != "") {
                $statement->bindParam(':foto', $foto, PDO::PARAM_STR);
            }

            $statement->execute();

            $resul = 0;

            if ($statement->rowCount()) {
                $resul = 1;
            }
            //$statement->closeCursor();
            return $resul;

        } catch (Exception $e) {
            return $e->getMessage();
        }

    } //end update perfil

    public function changePassworduser($idper, $oldpass, $newpass)
    {
        $sql = "SELECT password FROM users where id=:idper";

        $statement = $this->pst->prepare($sql);

        $statement->bindParam(':idper', $idper, PDO::PARAM_INT);

        $res = $statement->execute();

        try {

            if ($res) {

                while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {

                    if (password_verify($oldpass, $fila['password'])) {

                        $statement->closeCursor();

                        $passcryp = password_hash($newpass, PASSWORD_DEFAULT, ['cost' => 12]);
                        date_default_timezone_set('America/Lima');
                        $fecha = date('Y-m-d H:i:s');

                        $query     = "UPDATE users SET fulldate=:fecha, password =:passwordnew  WHERE id_person =:idper";
                        $statement = $this->pst->prepare($query);
                        $statement->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                        $statement->bindParam(':passwordnew', $passcryp, PDO::PARAM_STR);
                        $statement->bindParam(':idper', $idper, PDO::PARAM_INT);

                        $resss = $statement->execute();

                        $resul = 0;

                        if ($statement->rowCount()) {
                            $resul = 1;
                        }

                        return $resul;

                    } else {
                        return 0;
                    }
                }

            } else {
                return 0;
            }

        } catch (Exception $e) {
            return $e->getMessage() . ' line: ' . $e->getLine() . ' code:' . $e->getCode();
        }

    }

}
