<?php

$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
// require_once($raiz.'/api/models/ClienteModel.php');  


class vehiculoView
{
    protected $model;
    // protected $vehiculo;
    // protected $cliente;
    // protected $itemView;
    // protected $itemModel;

    public function __construct()
    {
        // $this->model = new ClienteModel();
        // $this->vehiculo = new VehiculoModel();
        // $this->cliente = new ClienteModel();
        // $this->itemView = new itemOrdenView();
        // $this->itemModel = new ItemOrdenModel();
    }

    public function pantallaCrearEscojerClienteVehiculo()
    {
      ?>
      <div class="row mt-2" style="padding:5px;">
        <div class="row">
            <div  id="mostrar clientes">
               
                  <input 
                      type="text" class="form-control" 
                      id="buscarNombreCLiente"
                      placeholder="Buscar Nombre Cliente.."
                      onkeyup="buscarNombreLCienteApiCLientes();"
                      >
            </div>
         
          
        </div>
          <div id="traerclientesFiltros"></div>
      </div>
      
      <?php
    }

    public function buscarNombreLCienteApiCLientes($clientes)
    {
        echo '<table>';
        foreach($clientes as $cliente) 
            {
                echo '<tr>';
                echo '<td><button clas="btn btn-primary" onclick="escogerClienteApi('.$cliente['idcliente'].')"></button>'.$cliente['nombre'].'</td>';
                echo '<td>'.$cliente['telefono'].'</td>';  
                echo '</tr>';
            }
        echo '</table>';
    }

}
