<?php

require_once dirname(__FILE__).'/../config/Conexion.php';

class Size
{

    private $conexion;
    private $pst;
    private $product = array();

    public function __construct()
    {

        $this->conexion = new Conexion();
        $this->pst      = $this->conexion->getConectar();

    }

    public function listAllSize()
    {
        $sql = "INSERT INTO personoffice (id, role, idoffice, idperson, state) VALUES (:role, :idoffice, :idperson, :state); ";

        $query = "select id, name from size;";
        $res   = $this->pst->query($query);

        if ($res) {
            while ($list = $res->fetch(PDO::FETCH_ASSOC)) {
                $this->product['data'][] = $list;
                //array_push($this->product,$list);
            }
            //var_dump($this->product);
            return $this->product;
        } else {
            return "no hay resultados";
        }
    }

}
