<?php

$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/api/models/OrdenModel.php');  
require_once($raiz.'/api/models/ItemOrdenModel.php');  
require_once($raiz.'/api/models/VehiculoModel.php');  
require_once($raiz.'/api/models/ClienteModel.php');  
require_once($raiz.'/api/views/itemOrdenView.php');  

class ordenView
{
    protected $model;
    protected $vehiculo;
    protected $cliente;
    protected $itemView;
    protected $itemModel;

    public function __construct()
    {
        $this->model = new OrdenModel();
        $this->vehiculo = new VehiculoModel();
        $this->cliente = new ClienteModel();
        $this->itemView = new itemOrdenView();
        $this->itemModel = new ItemOrdenModel();
    }

    public  function formuCreacionNuevaOrden()
    {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      </head>
      <body class="container">
        <div class="row">
            <div class="mt-3">
                <h3>Formulario de Creacion Nueva Orden</h3>
            </div>
            <div id="div_izquierda" class="col-lg-4 me-3 mt-2" style="padding:5px;">

                <input type="hidden" id ="indVerifPlaca" value=0>
                <input type="hidden" id ="idPlacaCrearOrden" value=0>

                <div class="row"  style="border: 2px solid #333;padding:10px;">
                    <div class="col-lg-4 ">
                        <!-- <label>Placa:</label> -->
                        <input placeholder =" Placa"class="form-control fs-2"" type="text"  id="placa123"name="placa123" onkeyup="verifiquePlaca();" value ="ale123">
                    </div>
                    <div class="col-lg-3">
                        <label> </label><br>
                        <button  class="btn btn-secondary btn-lg"   onclick="verificarPlacaInfoCompleta();">Verificar</button>
                    </div>
                    <div class="col-lg-3">
                        <label id="infoBusquedaPlaca"> </label>
                    </div>
                    <div class="mt-3  d-none d-flex" id="divBotonesSiExsite">
                        <button id="btnCrearOrden" class="btn btn-secondary  " onclick="formuCrearOrdenApiNuevaVersion();">Formu Crear Nueva Orden</button>
                        <button id="btnCrearOrden" class="btn btn-secondary  ms-auto" onclick="traerHistorialPlaca();">Ver Historial</button>
                    </div>
                </div>


                <div class="mt-3"  style="height:58vh;overflow-y:auto;border:2px solid #333;">
                    <h3> </h3>
                    Informacion Propietario:
                    <div id="informacionPropetario"></div>
                    <div id="informacionVehiculo"></div>
                </div>
             

            </div>
            <!-- <div class="col-lg-1" id="div del medio" > 
            </div> -->
            <div class="col-lg-7 mt-3" id="divHistorialPlaca" style="height:80vh;overflow-y:auto;border:2px solid #333;"> 
            </div>
        </div>
          <?php $this->modalOrdenes();  ?>
      </body>
      </html>
      <script src="../api/js/vehiculos.js"></script>
      <script src="../api/js/ordenes.js"></script>
      
      <?php
    }
    function mostrarInfoPropietario($infoPropietario)
    {
        ?>
        <div class="row">
            <div class="col-lg-2">
                <label class="fw-bold">Identidad:</label>    
                <label><?php   echo $infoPropietario['identi']; ?></label>
            </div>
            <div class="col-lg-2">
                <label class="fw-bold">Nombre:</label>    
                <label><?php   echo $infoPropietario['nombre']; ?></label>
            </div>
            <div class="col-lg-2">
                <label class="fw-bold">Direccion:</label>    
                <label><?php   echo $infoPropietario['direccion']; ?></label>
            </div>
            <div class="col-lg-2">
                <label class="fw-bold">Telefono:</label>    
                <label><?php   echo $infoPropietario['telefono']; ?></label>
            </div>
            <div class="col-lg-2">
                <label class="fw-bold">Email:</label>    
                <label><?php   echo $infoPropietario['email']; ?></label>
            </div>
        </div>


        <?php
    }
    function mostrarInfoVehiculo($infoVehiculo)
    {
    //       echo '<pre>'; 
    // print_r($infoVehiculo);
    // echo '</pre>';
    // die();
        ?>
        <div class="row">
            <div class="col-lg-2">
                <label class="fw-bold">Placa:</label>    
                <label><?php   echo $infoVehiculo['placa']; ?></label>
            </div>
            <div class="col-lg-2">
                <label class="fw-bold">Marca:</label>    
                <label><?php   echo $infoVehiculo['marca']; ?></label>
            </div>
            <div class="col-lg-2">
                <label class="fw-bold">Tipo:</label>    
                <label><?php   echo $infoVehiculo['tipo']; ?></label>
            </div>
            <div class="col-lg-2">
                <label class="fw-bold">modelo:</label>    
                <label><?php   echo $infoVehiculo['modelo']; ?></label>
            </div>
          
        </div>


        <?php
    }

    public function formuCrearOrdenApiNuevaVersion($idPlaca)
    {
        ?>
        <input type="hidden"   id="idPlaca"  value = "<?php   echo $idPlaca; ?>">
        <div class="row">
            <p class="fs-2 text-center">Formulario Creacion Nueva Orden</p>
            <div class="col-lg-3">
                <label>Kilometraje</label>  
                <input class="form-control" type="text"   id="kilometraje" >
            </div>
            <div class="col-lg-6">
                <label>Operario</label>  
                <input class="form-control" type="text"   id="operario" >
            </div>
            <div class="mt-2">
                <label>Trabajo a realizar</label>  
                <textarea rows="5" class="form-control" id ="observaciones"></textarea>
            </div>
            <div class="mt-3 text-center">
               <button  
                    class="btn btn-primary btn-lg" 
                     data-bs-toggle="modal" data-bs-target="#modalOrdenes"
                    onclick ="crearNuevaOrdenNuevaVersion(<?php   echo $idPlaca; ?>);" 
                >Crear Orden</button>
            </div>

        </div>
      
      <?php

    }
    public function pantallaModificarNueva($idOrden)
    {
        $infoOrden =  $this->model->traerOrdenId($idOrden);
        $infoVehiculo =      $this->vehiculo->traerInfoPlaca($infoOrden['placa']);
        $infoCliente =    $this->cliente->traerInfoCLienteId($infoVehiculo['propietario']);
        echo 'buenas '.$idOrden;
    }

    public function pantallaMOdificarOrden($idOrden)
    {
         $infoOrden =  $this->model->traerOrdenId($idOrden);
         $infoVehiculo =      $this->vehiculo->traerInfoPlaca($infoOrden['placa']);
         $infoCliente =    $this->cliente->traerInfoCLienteId($infoVehiculo['propietario']);
         
        //  echo 'llego hasta aca controlador';
        // echo '<pre>'; 
        // print_r($infoOrden);
        // echo '</pre>';
        // die();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        </head>
        <body>
        <div class="container mt-3">
            <input type="hidden"  id="idOrdenOculto"  value="<?php   echo $_REQUEST['idorden'];?>">

            <div class="mt-3">
                        <!-- <div align="center">
                             <h3>

                                 <a href="../menu_principal.php">  Menu Principal  </a>  <br>
                                 <a href="../orden/muestre_orden.php">  Menu Ordenes  </a>  
                                </h3>
                        </div> -->
            <div>

            <div >
                <table border = "1">
                    <tr>
                        <td colspan="2" rowspan="4"></td>
                        <td colspan="2"><h3>ORDEN DE TRABAJO</h3></td>
                        <td >
                            <input onfocus="blur();"  name="orden" id = "orden" type="text" size="20" value = "<? echo $infoOrden['orden']  ?>"  >
                            <input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "<? echo $_REQUEST['idorden']  ?>"  >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div align="center">NIT 8300507711-7 </div></td>
                        <td>CLAVE</td>
                    </tr>
                    <tr>
                        <td colspan="2"><div align="center">TELS 4056244/3114977845 </div></td>
                        <td><input name="clave" id = "clave" type="text" size="20" ></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div align="center">CRA 53 # 5B-69 </div></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="85">FECHA</td>
                        <td colspan="2"><input onfocus="blur();" size=10 name=fecha id = "fecha"  value= <? echo $infoOrden['fecha']  ;?>></td>
                        <td width="123">MARCA</td>
                        <td width="141"><input onfocus="blur();" name="marca" id = "marca" type="text"  value = "<? echo $infoVehiculo['marca']  ?>"></td>
                    </tr>
                    <tr>
                        <td>NOMBRE</td>
                        <td colspan="2"><input onfocus="blur();" name="nombre"  id = "nombre" type="text"  value = "<?php echo $infoCliente['nombre']; ?> "></td>
                        <td>TIPO</td>
                        <td><input  onfocus="blur();" name="tipo" type="text"  value = "<? echo $infoVehiculo['tipo']  ?>"></td>
                    </tr>
                    <tr>
                        <td>CC/NIT</td>
                        <td colspan="2"><input  onfocus="blur();"  name="identificacion" type="text"  value = "<?php echo $infoCliente['identi']; ?> "></td>
                        <td>MODELO</td>
                        <td><input  onfocus="blur();" name="modelo" type="text"  value = "<? echo $infoVehiculo['modelo']  ?>"></td>
                    </tr>
                    <tr>
                        <td>DIRECCION</td>
                        <td colspan="2"><input  onfocus="blur();" name="direccion" type="text" size="50" value = "<? echo $infoCliente['direccion']  ?>"  ></td>
                        <td>PLACA</td>
                        <td><input  onfocus="blur();"  name="placa" id = "placa" type="text" size="10" value = "<? echo $infoVehiculo['placa']  ?>"  ></td>
                    </tr>
                    <tr>
                        <td>TELEFONO</td>
                        <td colspan="2"><input  onfocus="blur();"  name="telefono" type="text" size="40" value = "<? echo $infoCliente['telefono']  ?>"></td>
                        <td>COLOR</td>
                        <td><input   onfocus="blur();" name="color" type="text" size="20" value = "<? echo $infoVehiculo['color']  ?>" ></td>
                    </tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    <td>KILOMETRAJE</td>
                    <td><input name="kilometraje"  id = "kilometraje"  type="text" size="20" value = "<? echo $infoOrden['kilometraje']  ?>" ></td></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    <td>OPERARIO</td>
                    <td><input name="mecanico"   id = "mecanico"  type="text" size="20" value = "<? echo $infoOrden['mecanico']  ?>" ></td></tr>
                    <tr>
                     <tr>
                    <td colspan="11"><div align="center">TRABAJO A REALIZAR </div></td>
                    </tr>
                    <tr>
                        <td height="80" colspan="11">
                        <textarea class="form-control"  name="descripcion"  id = "descripcion" cols="90" rows="4"> <?php  echo $infoOrden['observaciones']?></textarea>
                        </td>
                    </tr>
                    </table>

                </div>

                <div class="mt-3">
                        <?php   
                             $this->itemView->mostrarItemsNuevo($_REQUEST['idorden']); 
                        ?>
                </div>

                <div class="mt-3">
                        <?php   
                             $this->parteIventarioBasico($infoOrden); 
                        ?>

                </div>
                    <div class="mt-3">
                        <div align="center">
                            <!-- <href>Pantalla Ordenes</href> -->
                            <a href="../menu_principal.php"><h2>  Menu Principal  </h2></a>  
                            <a href="../orden/muestre_orden.php"><h2>  Menu Ordenes  </h2></a>  
                        </div>
                    <div>
                </div>
                </div>
                <script>
              
                     function actualizarOrdenNuevo(){
                            var idOrden =  document.getElementById("idOrdenOculto").value;
                            var kilometraje =  document.getElementById("kilometraje").value;
                            var mecanico =  document.getElementById("mecanico").value;
                            var observaciones =  document.getElementById("descripcion").value;
                            var radio =  document.getElementById("radio");
                            var antena =  document.getElementById("antena");
                            var repuesto =  document.getElementById("repuesto");
                            var herramienta =  document.getElementById("herramienta");
                            var otros =  document.getElementById("otros").value;

                            if(radio.checked){ radio=1}else{radio=0}
                            if(antena.checked){ antena=1}else{antena=0}
                            if(repuesto.checked){ repuesto=1}else{repuesto=0}
                            if(herramienta.checked){ herramienta=1}else{herramienta=0}

                            const http=new XMLHttpRequest();
                            const url = '../api/api.php';
                            http.onreadystatechange = function(){
                                if(this.readyState == 4 && this.status ==200){
                                    // var  resp = JSON.parse(this.responseText); 
                                    // document.getElementById("div_resultados_items_nuevo").innerHTML = this.responseText; 
                                    alert('orden Actualizada');
                                }
                            };
                            http.open("POST",url);
                            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            http.send("opcion=actualizarOrdenNuevo"
                            +"&idOrden="+idOrden  
                            +"&kilometraje="+kilometraje  
                            +"&mecanico="+mecanico  
                            +"&observaciones="+observaciones  
                            +"&radio="+radio  
                            +"&antena="+antena  
                            +"&repuesto="+repuesto  
                            +"&herramienta="+herramienta  
                            +"&otros="+otros  
                        );
                        limpiarCampos();
                }
                </script>
        </div>
        </body>
        </html>
        <?php
    }
    
    public function parteIventarioBasico($infoOrden)
    {
    ?>
        <table border = "1">
        <tr>
            <td colspan="7" align="center">INVENTARIO</td>
        </tr>
        <tr>
            <td width="85">RADIO</td>
            <td width="144">
            <?  if ($infoOrden['radio']=="1"){echo '<input name = "radio" id="radio"  type="checkbox" checked  value = "1" >';} 
                else {echo '<input  name = "radio" id="radio"  type="checkbox" unchecked   value = "1"  >';}  ?>		</td>
            <td width="199">HERRAMIENTA</td>
            <td colspan="4"><label>
        
            <?  if ($infoOrden['herramienta']=="1"){echo '<input name = "herramienta" id="herramienta"  type="checkbox" checked value = "1" >';} else {echo '<input  name = "herramienta" id="herramienta"  type="checkbox" unchecked value = "1" >';}  ?>
            </label></td>
        </tr>
        <tr>
            <td>ANTENA</td>
            <td><label><?  if ($infoOrden['antena']=="1"){echo '<input name = "antena" id="antena"  type="checkbox" checked value = "1"  >';} else {echo '<input  name = "antena" id="antena"  type="checkbox" unchecked value = "1" >';}  ?>
            </label></td>
            <td colspan="5" rowspan="2">OTROS
            <label>
                <textarea name="otros" id = "otros" cols="50" rows="2"> <?php  echo $infoOrden['otros']?></textarea>
            </label></td>
        </tr>
        <tr>
            <td>REPUESTO</td>
            <td><label><?  if ($infoOrden['repuesto']=="1"){echo '<input name = "repuesto" id="repuesto"  type="checkbox" checked value = "1" >';} else {echo '<input  name = "repuesto" id="repuesto"  type="checkbox" unchecked value = "1" >';}  ?>
            
            </label></td>
        </tr>
        <tr>
            <td>IVA</td>
            <td><input onfocus="blur();" name="iva" type="text" id = "iva"  value = "<?php echo $infoOrden['iva']; ?>"</td>
            <td>&nbsp;</td>
            <td width="123">&nbsp;</td>
            <td width="141">&nbsp;</td>
            <td width="48">&nbsp;</td>
            <td width="-1">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td colspan="7"><button type ="button"  onclick= "actualizarOrdenNuevo();" ><h4>ACTUALIZAR_ORDEN</h4></button></td>
        </tr>
        </table>
    <?php
    }
    
    public function mostrarHistorialPlaca($historiales)
    {
        ?>
        <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Orden</th>
                        <th>Items</th>
                        <th>Placa</th>
                       
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                       foreach($historiales as $histo)
                       {
                          $numero = $numeroItems =  $this->itemModel->traerNumeroItemsOrden($histo['id']); 
                          echo '<tr>';  
                          echo '<td><button 
                                        class="btn btn-secondary"
                                        onclick="mostrarInfoOrdenNuevo('.$histo['id'].')"
                                        data-bs-toggle="modal" data-bs-target="#modalOrdenes"
                                >'.$histo['fecha'].'</button></td>'; 
                                echo '<td>'.$histo['orden'].'</td>'; 
                                echo '<td>'.$numero.'</td>'; 
                          echo '<td>'.$histo['placa'].'</td>'; 
                          echo '</tr>';  
                        }  
                    ?>
                </tbody>
            </table>


        <?php
    }
    public function modalOrdenes()
    {
        ?>
        <div class="modal fade modal-lg" id="modalOrdenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ordenes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body " id="modalOrdenesBody">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
        </div>

        <?php
    }

    public function mostrarInfoOrdenNuevo($idOrden)
    {
        $infoOrden = $this->model->traerOrdenId($idOrden);
        // $items = $this->itemView->mostrarSoloItems($idOrden);
        ?>
        <div>
            <div class="mt-3">
                <textarea class="form-control"><?php   echo $infoOrden['observaciones'];  ?></textarea>
            </div>
            <div class="mt-3">
                   <?php $this->itemView->soloMostrarSoloItems($idOrden); ?>
            </div>
        </div>

        <?php
    }
    public function mostrarAvisoOrdenGrabada($idOrden)
    {
         $infoOrden =  $this->model->traerOrdenId($idOrden);
        ?>
        <div>
            <p>Orden Grabada exitosamente</p>
            <div>
                <button class="btn btn-primary"  onclick="pantallaModificarNueva(<?php   echo $idOrden; ?>);">Agregar Items Orden</button>
            </div>
        </div>
        <?php
    }
}

?>