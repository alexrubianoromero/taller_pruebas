<?php

// echo 'llego hasta aca controlador';
// echo '<pre>'; 
// print_r($_REQUEST);
// echo '</pre>';
//die();
$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/api/models/ClienteModel.php');  
require_once($raiz.'/api/views/clienteView.php');  
require_once($raiz.'/api/views/vehiculoView.php');  


class clientesController 
{
    protected $model;
    protected $view;
    protected $vehiculoView;

     public function __construct()
    {
        // echo 'llego controlador api '; 
        $this->model = new ClienteModel();
        $this->view = new clienteView();
        $this->vehiculoView = new vehiculoView();


         if($_REQUEST['opcion']=='pruebadesdeClientes')
        {
            // $this->view->pantallaCrearEscojerCliente();
            echo 'prueba desde clientes ';
        }
         if($_REQUEST['opcion']=='pantallaCrearEscojerCliente')
        {
            $this->view->pantallaCrearEscojerCliente();
        }
         if($_REQUEST['opcion']=='fomularioNuevoCLiente')
        {
            $this->view->fomularioNuevoCLiente();
        }
        
         if($_REQUEST['opcion']=='buscarNombreLCienteApiCLientes')
        {
            $clientes = $this->model->traerClientesFiltroNOmbre($_REQUEST['nombre']);
            $this->view->buscarNombreLCienteApiCLientes($clientes);
        }
         if($_REQUEST['opcion']=='registrarCLienteNUevoApi')
        {
            $clientes = $this->model->registrarCLienteNUevoApi($_REQUEST);
            $maxId = $this->model->traerUltimoId();
            //pantalla vehiculo con idcliente
            $this->vehiculoView->formuCreacionVehiculoIdCliente($maxId); 
        }
    }


}