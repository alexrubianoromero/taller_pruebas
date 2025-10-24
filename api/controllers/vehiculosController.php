<?php
$raiz = dirname(dirname(dirname(__file__)));
// die('congtroler'.$raiz);
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
        
        //  if($_REQUEST['opcion']=='pantallaCrearEscojerCliente')
        // {
        //     $this->view->pantallaCrearEscojerCliente();
        // }
        
        //  if($_REQUEST['opcion']=='buscarNombreLCienteApiCLientes')
        // {
        //     $clientes = $this->model->traerClientesFiltroNOmbre($_REQUEST['nombre']);
        //     $this->view->buscarNombreLCienteApiCLientes($clientes);
        // }
         if($_REQUEST['opcion']=='registrarVehiculoNuevoApi')
        {
            // die('lleo aca');
            $this->model->registrarVehiculoNuevoApi($_REQUEST);
            //mostrar pantalla para crear la orden 
            // $this->view->buscarNombreLCienteApiCLientes($clientes);
        }
    }


}