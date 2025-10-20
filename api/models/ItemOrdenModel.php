<?php

// $raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ItemOrdenModel extends Conexion
{

    // public function crearOrden($placa,$numeroOrden,$iva)
    // {
    //     $verificar = $this->verificarNumeroOrden($numeroOrden);
    //     if($verificar == 0)
    //     {
    //         // die('llego al modelo');
    //         $sql = "insert into ordenes (placa,orden,iva,id_empresa,estado,tipo_orden) 
    //         values ( '".$placa."','".$numeroOrden."','".$iva."','2','0','1')";
    //         // die($sql);
    //         $query = $this->connectMysql()->prepare($sql); 
    //         $results = $query -> fetch(PDO::FETCH_ASSOC); 
    //         $query -> execute(); 
    //         $this->desconectar();
    //         // die('pasoo33345');
    //     }
    // }

    public function traerItemsOrden($idOrden)
    {
        $sql= "select * from item_orden where no_factura = '".$idOrden."' order by id_item desc ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function traerNumeroItemsOrden($idOrden)
    {
        $sql= "select count(*) as numero from item_orden where no_factura = '".$idOrden."' ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $result = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $result['numero'];
    }


    public function traerItemOrdenIdItem($idItem)
    {
        $sql= "select * from item_orden where id_item = '".$idItem."' order by id_item desc ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function eliminarItemNuevaForma($idItem)
    {
        $sql= "delete  from item_orden where id_item = '".$idItem."'";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        // $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        // return $results;
    }


    
    public function agregarItemNuevo($request)
    {
            $sql = "insert into item_orden (no_factura,codigo,descripcion,cantidad,valor_unitario,total_item,id_empresa) 
            values ( '".$request['idOrden']."','".$request['codigo']."','".$request['descripcion']."'
            ,'".$request['cantidad']."'
            ,'".$request['valor_unit']."'
            ,'".$request['totalpan']."'
            ,'2'
            )";
            // die($sql);
            $query = $this->connectMysql()->prepare($sql); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $query -> execute(); 
            $this->desconectar();
    }


    public function ajustarSumarInventario($request)
    {
        $infoActualCod = $this->traerInfoCodigoCod($request['codigo']);
        $infoItem = $this->traerItemOrdenIdItem($request['idItem']);

        // echo '<pre>'; 
        // print_r($infoItem);
        // echo '</pre>';
        // die();
        $cantidadActual = $infoActualCod['cantidad'];
        $nuevoSaldo = $cantidadActual + $infoItem['cantidad'];
        $sql = "update productos set  cantidad = '".$nuevoSaldo."' where codigo_producto = '".$request['codigo']."'   ";
        $query = $this->connectMysql()->prepare($sql); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $query -> execute(); 
        $this->desconectar();
    }

    public function ajustarRestarInventario($request)
    {
        $infoActualCod = $this->traerInfoCodigoCod($request['codigo']);
        $cantidadActual = $infoActualCod['cantidad'];
        $nuevoSaldo = $cantidadActual - $request['cantidad'];
        $sql = "update productos set  cantidad = '".$nuevoSaldo."' where codigo_producto = '".$request['codigo']."'   ";
        $query = $this->connectMysql()->prepare($sql); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $query -> execute(); 
        $this->desconectar();
    }

    public function traerInfoCodigoCod($codProduc)
    {
        $sql = "select * from productos where codigo_producto = '".$codProduc."'  ";
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }
    // public function traerIdMaxOrdenes()
    // {
    //     $sql = "select max(id) as maxId from ordenes ";
    //     // die($sql);
    //     $query = $this->connectMysql()->prepare($sql); 
    //     $query -> execute(); 
    //     $results = $query -> fetch(PDO::FETCH_ASSOC); 
    //     $this->desconectar();
    //     // die('desde modelo '.$results['maxId']);
    //     return $results['maxId'];
    // }




}


?>