<?php

session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>imprimir orden</title>
  
            <link rel="stylesheet" href="../css/normalize.css">
          <link rel="stylesheet" href="../css/style.css">
         
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:200px;
	height:67px;
	z-index:1;
	left: 533px;
	top: 115px;
}
-->
</style>
</head>
<body>
<?php

include('../numerosALetras.class.php');
  $n = new numerosALetras ( 159 ) ; 
//echo $n -> resultado ;
//$letras = $n -> resultado ;
//echo '<br>letras'.$letras; 
//echo
/*
 '<pre>';
print_r($_GET);
echo '</pre>';
*/


//exit();





include('../valotablapc.php');  
include('../funciones.php'); 
include('../num2letras.php'); 

/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();
/*
$sql_placas = "select cli.nombre as nombre ,cli.identi as identi ,cli.direccion as direccion,cli.telefono as telefono ,car.placa as placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
 where o.id = '".$_GET['idorden']."' ";
 */
$sql_ruta_imagen = "select ruta_imagen from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_ruta_imagen,$conexion);
$ruta_imagen = mysql_fetch_assoc($consulta_empresa);  
$ruta_imagen = '../logos/'.$ruta_imagen['ruta_imagen'];

/*
echo  '<pre>';
print_r($ruta_imagen);
echo '</pre>';
echo '<br>'.$ruta_imagen;
exit();
*/


$sql_placas = "select cli.nombre as nombre ,cli.identi as identi ,cli.direccion as direccion,cli.telefono as telefono ,car.placa as placa,
car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.kilometraje,o.mecanico
 ,f.numero_factura as numero_factura,f.fecha as fecha_factura,f.sumaitems as subtotalfac ,
 f.valor_iva as ivafac ,f.total_factura as totalfac ,f.id_orden as id_orden,f.valor_retefuente as retefuentefac,f.resolucion as resolucion,
  f.elaborado_por
 , e.resolucion as empreresolucion
 , e.prefijo_factura as prefijo ,e.nombre as empresa ,e.identi,e.direccion,e.telefonos
 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
inner join $tabla11 as f  on (f.id_orden = o.id)
inner join $tabla10  as e on (e.id_empresa = f.id_empresa) 
 where f.id_factura = '".$_GET['id_factura']."' ";


 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);


$sql_items_orden = "select * from $tabla11 where id_factura = '".$_GET['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);

/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/


//$fechapan =  time();
?>
<br>
<br>
<div  id = "imprimir">
<table width="90%" border="1">
  <tr>
    <td colspan="3" rowspan="2"><h7><div align="center"><?php  echo $datos[0]['empresa']; ?>  </div></h7>  <h7><div align="center"><?php  echo $datos[0]['identi']; ?> </div> 
    </h7>      <h7><div align="center"><?php  echo $datos[0]['direccion']; ?> </div> 
      </h7>    <h7><div align="center"><?php  echo $datos[0]['telefonos']; ?> </div> 
    </h7></td>
    <td width="185" rowspan="2"><div id="Layer1"></div>      
      <img src="<?php  echo $ruta_imagen    ?>" width="187" height="61"></td>
    <td colspan="2"> 
	<h7>
	<?php
  //$prefijo = '';
	   if( $datos[0]['resolucion'] == 1)
			  {  
          echo 'FACTURA DE VENTA No'; 
         // $prefijo = $datos[0]['prefijo'];
        }
      else { echo 'COTIZACION  No ';} 
	?>
	</h7>	  </td>
    <td colspan="2"><h7><?php  echo   $datos[0]['numero_factura'] ?></h7></td>
    </tr>
  

  <tr>
    <td colspan="4"><h7><?php  if( $datos[0]['resolucion'] == 1)
			 {echo 'RES DIAN No '.$datos[0]['empreresolucion']; }  ?></h7></td>
    </tr>
  
  <tr class = "sinborde">
    <td width="160" ><h7>FECHA</h7></td>
    <td colspan="3"><h7><?php echo $datos[0]['fecha_factura']  ?></h7></td>
    <td colspan="2"><h7>MARCA</h7></td>
    <td colspan="2"><h7><?php echo $datos[0]['marca']  ?></h7></td>
    </tr>
  <tr class = "sinborde">
    <td><h7>CLIENTE</h7></td>
    <td colspan="3"><h7><?php echo $datos[0]['nombre']  ?></h7></td>
    <td colspan="2"><h7>TIPO</h7></td>
    <td colspan="2"><h7><?php echo $datos[0]['tipo']  ?></h7></td>
    </tr>
  <tr class = "sinborde">
    <td><h7>NIT</h7></td>
    <td colspan="3"><h7><?php echo $datos[0]['identi']  ?></h7></td>
    <td colspan="2"><h7>MODELO</h7></td>
    <td colspan="2"><h7><?php echo $datos[0]['modelo']  ?></h7></td>
    </tr>
  <tr class = "sinborde">
    <td><h7>DIRECCION</h7></td>
    <td colspan="3"><h7><?php echo $datos[0]['direccion']  ?></h7></td>
    <td colspan="2"><h7>PLACA</h7></td>
    <td colspan="2"><h7><?php echo $datos[0]['placa']  ?></h7></td>
    </tr>
  <tr class = "sinborde">
    <td><h7>TELEFONO</h7></td>
    <td colspan="3"><h7><?php echo $datos[0]['telefono']  ?></h7></td>
    <td colspan="2"><h7>COLOR</h7></td>
    <td colspan="2"><h7><?php echo $datos[0]['color']  ?></h7></td>
    </tr>
	<tr >
    <td><h7>MECANICO</h7></td>
    <td colspan="2"><h7><?php echo $datos[0]['mecanico']  ?></h7></td>
    <td>&nbsp;</td>
    <td colspan="2"><h7>KILOMETRAJE</h7></td>
    <td colspan="2"><h7><?php echo $datos[0]['kilometraje']  ?></h7></td>
    </tr>
  <tr class = "sombra">
    <th><h7><div align="center">REFERENCIA</div></h7></th>
    <th colspan="4"><h7><div align="center">DESCRIPCION</div> </h7></th>
    <th width="144"><h7><div align="center">CANT</div></h7></th>
    <th width="84"><h7><div align="center">VR. UNIDAD </div></h7></th>
    <th width="102"><h7><div align="center">VR. TOTAL </div></h7></th>
  </tr>
  <!--  aqui se insertan los items -->
  <?php
    $id_empresa = $_SESSION['id_empresa'];
    $subtotal =  muestre_items($datos[0]['id_orden'],$tabla15,$conexion,$id_empresa); 
  //$valoriva = ($subtotal * $datos[0]['iva'])/100;
  if($subtotal > 750000)
	  			{
					$porcentaje_retencion = 4;
				}
	  else 		{
	  				$porcentaje_retencion = 0;
	  			}			
	  $retencion = ($valoriva * $porcentaje_retencion)/100;
	  $total = $subtotal + $valoriva  + $retencion ;
    /*
	  $n = new numerosALetras($datos[0]['totalfac']) ; 
	  $letras = $n -> resultado ;
    */
    $letras = num2letras($datos[0]['totalfac']);
	  

      //echo '<br>valor de conversion a letras <br>'.$n -> resultado ;
	  //include('../num2letras.php');
    //$resultadoletras = new num2letras($datos[0]['totalfac']);


   ?>
  
  <tr class = "sombra">
    <td ><h7>SON:</h7></td>
    <td colspan = "7"><h7><?php echo  $letras.' pesos';   ?></h7> </td>
    </tr>
  <tr>
    <td colspan="5" rowspan="4"><h7><div align="center">
	<?php  if( $datos[0]['resolucion'] == 1)
			 {echo 'ESTE ES UN DOCUMENTO TITULO VALOR SEGUN EL ARTICULO 772 DEL CODIGO DEL COMERCIO'; }  ?>
	 </div></td>
    <td colspan="2"><h7>SUBTOTAL</h7></td>
    <td><h7><div align = "right"><?php  echo $datos[0]['subtotalfac'] ?></div></h7></td>
  </tr>
  <?php
  
   
  ?>
  <tr>
    <td colspan="2"><h7>IVA</h7></td>
    <td><h7><div align = "right">
      <?php  echo $datos[0]['ivafac'] ;
	  	  ?>
    </div></h7></td>
  </tr>
  <tr>
    <td colspan="2"><h7>RETENCION</h7></td>
    <td><h7><div align ="right"  ><?php  echo $datos[0]['retefuentefac']  ?></div></h7></td>
  </tr>
  <tr>
    <td colspan="2"><h7>TOTAL</h7></td>
    <td><h7><div align = "right"><?php  echo $datos[0]['totalfac'] ?></div></h7></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="4"><h7>FIRMA ROBERTO CARS</h7> </td>
    <td colspan="2" rowspan="4"><h7>Recibi Firma Autorizada </h7></td>
    <td width="4">&nbsp;</td>
    <td colspan="3" rowspan="4">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2"><h7>Firma Autorizada</h7> </td>
    <td colspan="2"><h7>Firma y Sello del Cliente</h7> </td>
    <td colspan="4"><h7>Elaborado por:  </h7> <h7><?php    echo $datos[0]['elaborado_por'] ?> 
    </h7></td>
	</tr>
</table>


</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
