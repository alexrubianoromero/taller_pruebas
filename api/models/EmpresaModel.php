<?php

// $raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class EmpresaModel extends Conexion
{

    public function  traerInfoEmpresa()
    {
        $sql = "select * from empresa";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }


    public function actualizarContador($placa,$nuevoContador)
    {
        $sql = "update empresa 
        set contaor = '".$nuevoContador."' 
        ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $this->desconectar();
    }


    // public function traerPropietarioPlaca($placa)
    // {
    //     $sql = "select cli.* from cliente0 cli
    //             inner join carros ca on (ca.propietario =cli.idcliente)
    //             where  ca.placa = '".$placa."' ";
    //     $query = $this->connectMysql()->prepare($sql); 
    //     $query -> execute(); 
    //     $results = $query -> fetch(PDO::FETCH_ASSOC); 
    //     $this->desconectar();
    //     return $results;
    // }
}


?>