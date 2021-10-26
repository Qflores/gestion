<?php

require_once dirname(__FILE__) . "/configuration.php";

class Conexion
{

    private string $host;
    private string $user;
    private string $password;
    private string $db;
    private string $charset;

    private $conexion;
    private $pst;
    private $product = array();

    public function __construct()
    {
        $this->host     = HOST;
        $this->user     = USER;
        $this->password = PASSWORD;
        $this->db       = DATABASE;
        $this->charset  = CHARSET;
    }

    public function getConectar()
    {

        $cadena = 'mysql:host=' . $this->host . ';dbname=' . $this->db . ";charset=" . $this->charset;
        try {

            $this->conexion = new PDO($cadena, $this->user, $this->password);

            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conexion;

        } catch (Exception $e) {
            echo sprintf('Error %s exceptions: %s', get_class($e), $e->getMessage()) . PHP_EOL;
            return "error";
        }
    }

    public function Close()
    {

        $this->conexion->close();
    }
}
