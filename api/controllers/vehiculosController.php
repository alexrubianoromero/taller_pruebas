<?php

// echo 'llego hasta aca controlador';
// echo '<pre>'; 
// print_r($_REQUEST);
// echo '</pre>';
//die();
$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/api/models/VehiculoModel.php');  
require_once($raiz.'/api/views/vehiculoView.php');  


class vehiculosController 
{
    protected $model;
    protected $view;

     public function __construct()
    {
        // echo 'llego controlador api '; 
        $this->model = new VehiculoModel();
        $this->view = new vehiculoView();
        
         if($_REQUEST['opcion']=='pantallaCrearEscojerCliente')
        {
            $this->view->pantallaCrearEscojerCliente();
        }
        
         if($_REQUEST['opcion']=='buscarNombreLCienteApiCLientes')
        {
            $clientes = $this->model->traerClientesFiltroNOmbre($_REQUEST['nombre']);
            $this->view->buscarNombreLCienteApiCLientes($clientes);
        }
    }


}