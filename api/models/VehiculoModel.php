<?php

// $raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class VehiculoModel extends Conexion
{

    public function verificarPlaca($placa)
    {
        $sql = "select * from carros where placa = '".$placa."' ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        $filas = $query->rowCount();
        $respu['filas'] = $filas;
        $respu['datos'] = $results;
        return $respu;
    }
    public function traerInfoPlaca($placa)
    {
        $sql = "select * from carros where placa = '".$placa."' ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }
    public function traerInfoPlacaId($idVehiculo)
    {
        $sql = "select * from carros where idcarro = '".$idVehiculo."' ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }
    public function traerVehiculosIdCliente($idCliente)
    {
        $sql = "select * from carros where propietario = '".$idCliente."' ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }


    public function traerHistorialPlaca($placa)
    {
        $sql = "select * from ordenes where placa = '".$placa."' order by id desc ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function traerPropietarioPlaca($placa)
    {
        $sql = "select cli.* from cliente0 cli
                inner join carros ca on (ca.propietario =cli.idcliente)
                where  ca.placa = '".$placa."' ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function registrarVehiculoNuevoApi($request)
    {
        $sql = "insert into carros (placa,marca,tipo,color,modelo,propietario) 
        values(
        '".$request['placa']."'
        ,'".$request['marca']."'
        ,'".$request['tipo']."'
        ,'".$request['color']."'
        ,'".$request['modelo']."'
        ,'".$request['idCliente']."'
        )";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        // $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        // return $results;
    }

        public function traerUltimoIdVehiculos()
        {
            $sql ="select max(idcarro) as maxId from carros";
            $query = $this->connectMysql()->prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $this->desconectar();
            $maxId = $results['maxId'];
            return $maxId;
        }





}


?>