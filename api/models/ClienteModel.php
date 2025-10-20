<?php

// $raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ClienteModel extends Conexion
{

    public function  traerInfoCLienteId($idCliente)
    {
        $sql = "select * from cliente0  where idcliente = '".$idCliente."' ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }


    // public function actualizarContador($placa,$nuevoContador)
    // {
    //     $sql = "update empresa 
    //     set contaor = '".$nuevoContador."' 
    //     ";
    //     $query = $this->connectMysql()->prepare($sql); 
    //     $query -> execute(); 
    //     $this->desconectar();
    // }
}