<?php

// echo 'llego hasta aca controlador';
// echo '<pre>'; 
// print_r($_REQUEST);
// echo '</pre>';
//die();
$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/api/models/VehiculoModel.php');  
require_once($raiz.'/api/models/EmpresaModel.php');  
require_once($raiz.'/api/models/OrdenModel.php');  
require_once($raiz.'/api/models/IvaModel.php');  
require_once($raiz.'/api/models/ItemOrdenModel.php');  
require_once($raiz.'/api/views/itemOrdenView.php');  
require_once($raiz.'/api/views/ordenView.php');  


class apiController
{
    protected $model;
    protected $modelEmpresa;
    protected $ordenModel;
    protected $ivaModel;
    protected $itemModel;
    protected $itemView;
    protected $ordenView;

    public function __construct()
    {
        // echo 'llego controlador api '; 
        $this->model = new VehiculoModel();
        $this->modelEmpresa = new EmpresaModel();
        $this->ordenModel = new OrdenModel();
        $this->ivaModel = new IvaModel();
        $this->itemModel = new ItemOrdenModel();
        $this->itemView = new itemOrdenView();
        $this->ordenView = new ordenView();

        if($_REQUEST['opcion']=='traerHistorialPlaca')
        {
            $this->traerHistorialPlaca($_REQUEST['placa']);
        }
        if($_REQUEST['opcion']=='verificarPlaca')
        {
            $this->verificarPlaca($_REQUEST['placa']);
        }

        if($_REQUEST['opcion']=='verificarPlacaInfoCompleta')
        {
            $this->verificarPlacaInfoCompleta($_REQUEST['placa']);
        }
        if($_REQUEST['opcion']=='creacionOrdenNuevaForma')
        {
            $this->creacionOrdenNuevaForma($_REQUEST['placa']);
        }
        if($_REQUEST['opcion']=='agregarItemNuevo')
        {
            $this->agregarItemNuevo($_REQUEST);
        }
        if($_REQUEST['opcion']=='actualizarOrdenNuevo')
        {
            $this->ordenModel->actualizarOrdenNuevo($_REQUEST);
        }
        if($_REQUEST['opcion']=='eliminarItemNuevaForma')
        {
            $this->eliminarItemNuevaForma($_REQUEST);
        }
        if($_REQUEST['opcion']=='traerLaInfoDelCodigo')
        {
                
            $this->traerLaInfoDelCodigo($_REQUEST['codigo']);
        }
    }
    
    public function traerHistorialPlaca($placa)
    {
        $historiales = $this->model->traerHistorialPlaca($placa);
                    // echo '<pre>'; 
                    // print_r($historiales);
                    // echo '</pre>';
                    // die();
        $this->ordenView->mostrarHistorialPlaca($historiales);
    }

    public function traerLaInfoDelCodigo($codigo)
    {
        // die('llego controlador'); 
        $infoCodigo= $this->itemModel->traerInfoCodigoCod($codigo);
        // echo '<pre>'; 
        // print_r($infoCodigo);
        // echo '</pre>';
        echo json_encode($infoCodigo);
        exit();
    }
    public function eliminarItemNuevaForma($request)
    {
        // die('llego controlador'); 
        $infoItem = $this->itemModel->traerItemOrdenIdItem($request['idItem']);
        // $infoCodigo= $this->itemModel->traerInfoCodigoCod($infoItem['codigo']);
        //     echo '<pre>'; 
        // print_r($request);
        // echo '</pre>';
        // die();
        $request['codigo'] = $infoItem['codigo'];
        $this->itemModel->ajustarSumarInventario($request);
        $this->itemModel->eliminarItemNuevaForma($request['idItem']);
        $this->itemView->mostrarSoloItems($request['idOrden']); 
    }
    
    public function agregarItemNuevo($request)
    {
        $this->itemModel->agregarItemNuevo($request);
        //hacer el ajuste de inventario
        $this->itemModel->ajustarRestarInventario($request);
        
        //mostrar otra vez los codigos
        $this->itemView->mostrarSoloItems($request['idOrden']); 
        
    }

    public function verificarPlaca($placa)
    {
            $respuesta = $this->model->verificarPlaca($placa);
             if($respuesta['filas']>0)
             {
                $infoPropietario = $this->model->traerPropietarioPlaca($_REQUEST['placa']);
             }
             $verificacion['filas']=$respuesta['filas'];
             $verificacion['nombre']=$infoPropietario['nombre'];
             echo json_encode($verificacion);
             exit();
    }

    public function verificarPlacaInfoCompleta($placa)
    {
            $respuesta = $this->model->verificarPlaca($placa);
             if($respuesta['filas']>0)
             {
                $infoPropietario = $this->model->traerPropietarioPlaca($_REQUEST['placa']);
                $infoVehiculo = $respuesta['datos'];
                $respuesta['idPropietario'] = $infoPropietario['idcliente'];
                // $this->ordenView->mostrarInfoPropietario($infoPropietario); 
                // $this->ordenView->mostrarInfoVehiculo($infoVehiculo); 
                echo json_encode($respuesta);
                exit();
             }else {
                // echo 'No hay informacion de placa';
                $respuesta['filas']==0;
                echo json_encode($respuesta);
                exit();
             }
            //  $verificacion['filas']=$respuesta['filas'];
            //  $verificacion['nombre']=$infoPropietario['nombre'];
    }

    public function creacionOrdenNuevaForma($placa)
    {
        // echo 'llego hasta aca crear orden';
        $infoEmpresa =    $this->modelEmpresa ->traerInfoEmpresa();
        $contadorActual = $infoEmpresa['contaor'];
        $siguienteNumero = $contadorActual+1;
        $arrIva = $this->ivaModel->traerIva(); 
        $this->modelEmpresa->actualizarContador($placa,$siguienteNumero); 
        $this->ordenModel->crearOrden($placa,$siguienteNumero,$arrIva['iva']); 
        $idMax = $this->ordenModel->traerIdMaxOrdenes();
        // echo ('llego hasta aca nueva forma12345');
        // die('maximo id'.$idMax) ;
        echo json_encode($idMax);
        exit();
    }


}

?>