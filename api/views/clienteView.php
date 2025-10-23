<?php

$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
// require_once($raiz.'/api/models/ClienteModel.php');  


class clienteView
{
    protected $model;
    // protected $vehiculo;
    // protected $cliente;
    // protected $itemView;
    // protected $itemModel;

    public function __construct()
    {
        $this->model = new ClienteModel();
        // $this->vehiculo = new VehiculoModel();
        // $this->cliente = new ClienteModel();
        // $this->itemView = new itemOrdenView();
        // $this->itemModel = new ItemOrdenModel();
    }

    public function pantallaCrearEscojerCliente()
    {
      ?>
      <div class="row mt-2" style="padding:2px;">
          <div class="row" id="mostrar clientes">
                <div class="col-lg-5">
                    <input 
                        type="text" class="form-control" 
                        id="buscarNombreCLiente"
                        placeholder="Buscar Nombre Cliente.."
                        onkeyup="buscarNombreLCienteApiCLientes();"
                    >
                </div>
                <div class="col-lg-5">
                    <button class="btn btn-secondary" onclick="fomularioNuevoCLiente();">Nuevo</button>
                </div>
          </div>
          <div id="traerclientesFiltros" ></div>
      </div>
      
      <?php
    }

    public function buscarNombreLCienteApiCLientes($clientes)
    {
        echo '<table>';
        foreach($clientes as $cliente) 
            {
                echo '<tr>';
                echo '<td><button class="btn btn-primary mt-3" onclick="escogerClienteApi('.$cliente['idcliente'].')">'.$cliente['nombre'].'</button></td>';
                // echo '<td>'.$cliente['telefono'].'</td>';  
                echo '</tr>';
            }
        echo '</table>';
    }


    public function fomularioNuevoCLiente()
    {
        echo 'formu nuevo cliente';
    }

}
