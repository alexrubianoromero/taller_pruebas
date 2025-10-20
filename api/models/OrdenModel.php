<?php

// $raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class OrdenModel extends Conexion
{

    public function crearOrden($placa,$numeroOrden,$iva)
    {
        $verificar = $this->verificarNumeroOrden($numeroOrden);
        if($verificar == 0)
        {
            // die('llego al modelo');
            $sql = "insert into ordenes (placa,orden,iva,id_empresa,estado,tipo_orden) 
            values ( '".$placa."','".$numeroOrden."','".$iva."','2','0','1')";
            // die($sql);
            $query = $this->connectMysql()->prepare($sql); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $query -> execute(); 
            $this->desconectar();
            // die('pasoo33345');
        }
    }

    public function verificarNumeroOrden($numeroOrden)
    {
        $sql= "select * from ordenes where orden = '".$numeroOrden."'   ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        $filas = $query->rowCount();
        return $filas;
    }


    public function traerIdMaxOrdenes()
    {
        $sql = "select max(id) as maxId from ordenes ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        // die('desde modelo '.$results['maxId']);
        return $results['maxId'];
    }

    public function traerOrdenId($idOrden)
    {
        $sql = "select * from ordenes where id =  '".$idOrden."'  ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

      public function actualizarOrdenNuevo($request)
    {
         $sql = "update ordenes 
         set kilometraje = '".$request['kilometraje']."' 
         ,mecanico = '".$request['mecanico']."' 
         ,observaciones = '".$request['observaciones']."' 
         ,radio = '".$request['radio']."' 
         ,antena = '".$request['antena']."' 
         ,repuesto = '".$request['repuesto']."' 
         ,herramienta = '".$request['herramienta']."' 
         ,otros = '".$request['otros']."' 
         where  id = '".$request['idOrden']."'
        ";
        $query = $this->connectMysql()->prepare($sql); 
        $query->bindParam(':norecibo',$norecibo,PDO::PARAM_STR, 25);
        $query->execute();
        $this->desconectar();
    }




}


?>