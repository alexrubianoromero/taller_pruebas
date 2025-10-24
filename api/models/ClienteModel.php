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


    public function traerClientesPdo()
    {
        $sql = "select * from cliente0 order by nombre desc";
           $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }
    public function traerClientesFiltroNOmbre($nombre)
    {
        $sql = "select * from cliente0 where nombre like '%".$nombre."%' order by nombre desc";
           $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function registrarCLienteNUevoApi($request)
    {
        $sql = "insert into cliente0 (identi,nombre,telefono,direccion,email) 
        values(
        '".$request['identi']."'
        ,'".$request['nombre']."'
        ,'".$request['telefono']."'
        ,'".$request['direccion']."'
        ,'".$request['email']."'
        )";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
             $this->desconectar();
    }
    public function traerUltimoId()
    {
        $sql ="select max(idcliente) as maxId from cliente0";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        $maxId = $results['maxId'];
        return $maxId;
    }

   
}