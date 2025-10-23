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


class clientesController 
{
    protected $model;
    protected $view;

     public function __construct()
    {
        // echo 'llego controlador api '; 
        $this->model = new ClienteModel();
        $this->view = new clienteView();
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
    }


}