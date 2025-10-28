<?php

$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/api/models/ClienteModel.php');  


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
    public function muestreInfoLCienteId($idCliente)
    {
       $infoCliente =  $this->model->traerInfoCLienteId($idCliente);
      ?>
      <div>
        <div class="row">
            <div class="col-lg-3">
                <label>Nombre: <?php echo $infoCliente['nombre'] ; ?></label>

            </div>
        </div>
        <div></div>
      </div>
      <?php
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
                // echo '<td><button class="btn btn-primary mt-3" onclick="escogerClienteApi('.$cliente['idcliente'].')">'.$cliente['nombre'].'</button></td>';
                echo '<td><button class="btn btn-primary mt-3" onclick="formuCreacionVehiculoIdCliente('.$cliente['idcliente'].')">'.$cliente['nombre'].'</button></td>';
                // echo '<td>'.$cliente['telefono'].'</td>';  
                echo '</tr>';
            }
        echo '</table>';
    }


    public function fomularioNuevoCLiente()
    {
        ?>
        <div class="row mt-2">
            <p>Nuevo Propietario:</p>
            <div class="col-lg-3">
                <label>Identidad:</label>
                <input type="text" class="form-control" id="identi">
            </div>
            <div class="col-lg-8">
                <label>Nombre:</label>
                <input type="text" class="form-control" id="nombre">
            </div>
            <div class="col-lg-3">
                <label>Telefono:</label>
                <input type="text" class="form-control" id="telefono">
            </div>
            <div class="col-lg-6">
                <label>Direccion:</label>
                <input type="text" class="form-control" id="direccion">
            </div>
            <div class="col-lg-6">
                <label>Email:</label>
                <input type="text" class="form-control" id="email">
            </div>
            <div class="mt-4">
                <button class="btn btn-primary w-100" onclick="registrarCLienteNUevoApi();">Registrar</button>
            </div>
        </div>

        <?php
    }

}
