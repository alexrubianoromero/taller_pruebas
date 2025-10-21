<?php

// echo 'llego hasta aca controlador';
// echo '<pre>'; 
// print_r($_REQUEST);
// echo '</pre>';
$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/api/models/OrdenModel.php');  
require_once($raiz.'/api/models/VehiculoModel.php');  
require_once($raiz.'/api/models/EmpresaModel.php');  
require_once($raiz.'/api/models/IvaModel.php');  
// require_once($raiz.'/api/models/OrdenModel.php');  
// require_once($raiz.'/api/models/IvaModel.php');  
// require_once($raiz.'/api/models/ItemOrdenModel.php');  
require_once($raiz.'/api/views/ordenView.php');  


class ordenesController
{
    protected $model;
    protected $ivaModel;
    protected $vehiculoModel;
    protected $view;
    protected $modelEmpresa;
    // protected $ordenModel;
    // protected $ivaModel;
    // protected $itemModel;
    // protected $itemView;

    // echo 'llego hasta aca controlador';
    // echo '<pre>'; 
    // print_r($_REQUEST);
    // echo '</pre>';
    // die();
    public function __construct()
    {
        // echo 'llego controlador api '; 
        $this->model = new OrdenModel();
        $this->ivaModel = new IvaModel();
        $this->vehiculoModel = new VehiculoModel();
        $this->modelEmpresa = new EmpresaModel();
        // $this->ordenModel = new OrdenModel();
        // $this->ivaModel = new IvaModel();
        // $this->itemModel = new ItemOrdenModel();
        $this->view = new ordenView();

        if($_REQUEST['opcion']=='pantallaModificarNueva')
        {
            // die('llego aca'.$_REQUEST['idorden']);
            $this->view->pantallaModificarNueva($_REQUEST['idorden']);
        }
        if($_REQUEST['opcion']=='pantallaModificarOrden123')
        {
            // die('llego aca'.$_REQUEST['idorden']);
            $this->view->pantallaMOdificarOrden($_REQUEST['idorden']);
        }
        if($_REQUEST['opcion']=='formuCreacionNuevaOrden')
            {
                $this->view->formuCreacionNuevaOrden();
        }
        if($_REQUEST['opcion']=='mostrarInfoPropietario')
            {
                $this->view->mostrarInfoPropietario($_REQUEST['idPropietario']);
        }
        if($_REQUEST['opcion']=='mostrarInfoVehiculo')
        {
                $infoVehiculo=  $this->vehiculoModel->traerInfoPlacaId($_REQUEST['idcarro']);
                $this->view->mostrarInfoVehiculo($infoVehiculo);
        }

        if($_REQUEST['opcion']=='mostrarInfoOrdenNuevo')
            {
                // die('llego aca');
                $this->view->mostrarInfoOrdenNuevo($_REQUEST['idOrden']);
        }
        if($_REQUEST['opcion']=='formuCrearOrdenApiNuevaVersion')
            {
                $this->view->formuCrearOrdenApiNuevaVersion($_REQUEST['idPlaca']);
        }
        if($_REQUEST['opcion']=='crearNuevaOrdenNuevaVersion')
        {
            $this->crearNuevaOrdenNuevaVersion($_REQUEST);
        }
        // if($_REQUEST['opcion']=='creacionOrdenNuevaForma')
        // {
        //     $this->creacionOrdenNuevaForma($_REQUEST['placa']);
        // }
        // if($_REQUEST['opcion']=='agregarItemNuevo')
        // {
        //     $this->agregarItemNuevo($_REQUEST);
        // }
    }
    
    
    
    public function agregarItemNuevo($request)
    {
        $this->itemModel->agregarItemNuevo($request);
        //hacer el ajuste de inventario
        
        //mostrar otra vez los codigos
        $this->itemView->mostrarItemsNuevo($request['idOrden']); 
        
    }


    public function crearNuevaOrdenNuevaVersion($request)
    {
        $infoEmpresa =  $this->modelEmpresa->traerInfoEmpresa();
        $sigNumeroOrden =  $infoEmpresa['contaor'] + 1;
        $infoVehiculo =   $this->vehiculoModel->traerInfoPlacaId($request['idPlaca']); 
        $iva = $this->ivaModel->traerIva(); 
        $infoCreacionOrden['placa'] = $infoVehiculo['placa'];
        $infoCreacionOrden['orden'] = $sigNumeroOrden;
        $infoCreacionOrden['iva'] = $iva['iva'];
        $this->model->crearNuevaOrdenNuevaVersion($infoCreacionOrden,$request);
         $this->modelEmpresa->actualizarContador($infoVehiculo['placa'],$sigNumeroOrden) ;
        // $this->model->actualizarNumeroOrden($request['idOrden'],$sigNumeroOrden);
        // die('llegpo a creaR ORDEN1234');
        $idMax=   $this->model->traerIdMaxOrdenes();
        // die($idMax);
        // echo json_encode($idMax);
        // exit();
        $this->view->mostrarAvisoOrdenGrabada($idMax);
    }

    // public function verificarPlaca($placa)
    // {
    //         $respuesta = $this->model->verificarPlaca($placa);
    //          if($respuesta['filas']>0)
    //          {
    //             $infoPropietario = $this->model->traerPropietarioPlaca($_REQUEST['placa']);
    //          }
    //          $verificacion['filas']=$respuesta['filas'];
    //          $verificacion['nombre']=$infoPropietario['nombre'];
    //          echo json_encode($verificacion);
    //          exit();
    // }

    // public function creacionOrdenNuevaForma($placa)
    // {
    //     // echo 'llego hasta aca crear orden';
    //     $infoEmpresa =    $this->modelEmpresa ->traerInfoEmpresa();
    //     $contadorActual = $infoEmpresa['contaor'];
    //     $siguienteNumero = $contadorActual+1;
    //     $arrIva = $this->ivaModel->traerIva(); 
    //     $this->modelEmpresa->actualizarContador($placa,$siguienteNumero); 
    //     $this->ordenModel->crearOrden($placa,$siguienteNumero,$arrIva['iva']); 
    //     $idMax = $this->ordenModel->traerIdMaxOrdenes();
    //     // echo ('llego hasta aca nueva forma12345');
    //     // die('maximo id'.$idMax) ;
    //     echo json_encode($idMax);
    //     exit();
    // }


}

?>