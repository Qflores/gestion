
<?php

require_once dirname(__FILE__).'/../config/Conexion.php';
class Worker {

    private $conexion;
    private $pst;
    private $worker = array();

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->pst      = $this->conexion->getConectar();

    }

    public function gerPerfilPerson($idu)
    {

        $query = "SELECT id,names,email,phone,document,address, type,foto FROM persona where id =:idper;";

        $statement = $this->pst->prepare($query);
        $statement->bindParam(':idper', $idu, PDO::PARAM_INT);
        $res = $statement->execute();

        if ($res) {

            while ($list = $statement->fetch(PDO::FETCH_ASSOC)) {
                $this->worker[] = $list;
            }
            $statement->closeCursor();
            if (count($this->worker) > 0) {
                return $this->worker;
            }

            return 0;

        } else {
            return 0;
        }
    }

    public function listAllWorker()
    {

        $query = "call sp_listusers();";
        $res   = $this->pst->query($query);

        if ($res) {
            while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
                $this->worker['data'][] = $list;
            }

            return $this->worker;
        } else {
            return "no hay resultados";
        }
    }

    public function saveUpdateWorker($idc, $names, $email, $phone, $document, $address, $state, $username, $password, $question, $userid)
    {
        $queryworker = "";
        $arrayworker = null;

        $queryuser = "";
        $arrayuser = null;
        $sms       = "";
        // hora peruana
        date_default_timezone_set('America/Lima');
        $fechaactual = date('Y-m-d H:i:s');

        if ($idc == 0 || $idc == '0') {
            $queryworker = "INSERT INTO persona (names, email, phone, document, address, type, state) VALUES(:names, :email, :phone, :document, :address, :type, :state);";
            $arrayworker = array('names' => $names, 'email' => $email, 'phone' => $phone, 'document' => $document, 'address' => $address, 'type' => '2', 'state' => '1');
            $sms         = "Guardar";
        }

        if ($idc > 0 || $idc != '0') {
            $queryworker = "UPDATE persona SET names = :names, email = :email, phone = :phone, document = :document, address = :address, state = :state WHERE id = :id";
            $arrayworker = array('names' => $names, 'email' => $email, 'phone' => $phone, 'document' => $document, 'address' => $address, 'state' => $state, 'id' => $idc);
            $sms         = "Actualizar";
        }

        if ($idc > 0 || $idc != '0') {
            $queryuser = "UPDATE users SET fulldate = :fecha WHERE id = :id";
            $arrayuser = array('fecha' => $fechaactual, 'id' => $userid);
            $sms       = $sms . " el usuario";
        }

        try {
            // From this point and until the transaction is being committed every change to the database can be reverted
            $this->pst->beginTransaction();

            // Insert the metadata of the worker into the database
            $pq = $this->pst->prepare($queryworker);
            // insert into table
            $res = $pq->execute($arrayworker);

            $workerId = "";
            if ($idc == 0 || $idc == '0') {
                // Get the generated worker_id
                $workerId   = $this->pst->lastInsertId();
                $passencryp = $passcryp = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

                $queryuser = "INSERT INTO users (username, password, question, fulldate, id_person, role) VALUES (:username, :password, :question, :fecha, :id_person, :role);";
                $arrayuser = array('username' => $username, 'password' => $passencryp, 'question' => $question, 'fecha' => $fechaactual, 'id_person' => $workerId, 'role' => 'worker');
                $sms       = $sms . " el usuario";

            }

            $pq  = $this->pst->prepare($queryuser);
            $res = $pq->execute($arrayuser);

            if ($idc == 0 || $idc == '0') {

                $uquery = "INSERT INTO personoffice (idoffice,idperson)VALUES(:idoffice,:idperson);";

                session_start();
                $secc      = $_SESSION['ux'];
                $idempresa = $secc[6];
                $arrabus   = array(
                    'idoffice' => $idempresa,
                    'idperson' => $workerId);
                $pq = $this->pst->prepare($uquery);
                $pq->execute($arrabus);
            }

            $this->pst->commit();

            return $res;

        } catch (Exception $e) {
            $this->pst->rollBack();
            return "No se pudo " . $sms . ", Error: " . $e->getMessage();
        }
    }

}



