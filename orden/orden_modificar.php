<?php
session_start();
$raiz = dirname(dirname(__file__));
// die($raiz);
require_once($raiz.'/api/views/itemOrdenView.php');  
$view = new itemOrdenView();

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();

?>

<!DOCTYPE html>
<html lang="es" >
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
</head>
<body>
<?php






include('../valotablapc.php');  
include('../funciones.php'); 
/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();

$sql_placas = "select cli.nombre,cli.identi,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
 where o.id = '".$_REQUEST['idorden']."'   and   o.id_empresa = '2'  and o.estado = '0' ";
//  die($sql_placas);
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
if ($filas == 0 ) {echo '<BR><BR>ESTA ORDEN NO SE PUEDE MODIFICAR';}
//echo '<br>filas =='.$filas;

 $datos = get_table_assoc($datos); 


$sql_items_orden = "select * from $tabla15 where no_factura = '".$_REQUEST['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);
$factupan = $_REQUEST['idorden'];
/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/



//$fechapan =  time();
?>
<div id = "divorden">
  <form action="" method="post">
    <table border = "1">
      <tr>
        <td colspan="2" rowspan="4"></td>
        <td colspan="2"><h3>ORDEN DE TRABAJO</h3></td>
        <td >
                 <input name="orden" id = "orden" type="text" size="20" value = "<? echo $datos[0]['orden']  ?>"  >
                <input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "<? echo $_GET['idorden']  ?>"  >
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
        <td colspan="2"><input size=10 name=fecha id = "fecha"  value= <? echo $datos[0]['fecha']  ;?>></td>
        <td width="123">MARCA</td>
        <td width="141"><input name="marca" id = "marca" type="text"  value = "<? echo $datos[0]['marca']  ?>"></td>
      </tr>
      <tr>
        <td>NOMBRE</td>
        <td colspan="2"><input name="nombre"  id = "nombre" type="text"  value = "<?php echo $datos[0]['nombre']; ?> "></td>
        <td>TIPO</td>
        <td><input name="tipo" type="text"  value = "<? echo $datos[0]['tipo']  ?>"></td>
      </tr>
      <tr>
        <td>CC/NIT</td>
        <td colspan="2"><input name="identificacion" type="text"  value = "<?php echo $datos[0]['identi']; ?> "></td>
        <td>MODELO</td>
        <td><input name="modelo" type="text"  value = "<? echo $datos[0]['modelo']  ?>"></td>
      </tr>
      <tr>
        <td>DIRECCION</td>
        <td colspan="2"><input name="direccion" type="text" size="50" value = "<? echo $datos[0]['direccion']  ?>"  ></td>
        <td>PLACA</td>
        <td><input name="placa" id = "placa" type="text" size="10" value = "<? echo $datos[0]['placa']  ?>"  ></td>
      </tr>
      <tr>
        <td>TELEFONO</td>
        <td colspan="2"><input name="telefono" type="text" size="40" value = "<? echo $datos[0]['telefono']  ?>"></td>
        <td>COLOR</td>
        <td><input name="color" type="text" size="20" value = "<? echo $datos[0]['color']  ?>" ></td>
      </tr>
	   <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	  <td>KILOMETRAJE</td>
	  <td><input name="kilometraje"  id = "kilometraje"  type="text" size="20" value = "<? echo $datos[0]['kilometraje']  ?>" ></td></tr>
	  <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	  <td>OPERARIO</td>
	  <td><input name="mecanico"   id = "mecanico"  type="text" size="20" value = "<? echo $datos[0]['mecanico']  ?>" ></td></tr>
      <tr>
      <tr>
        <td colspan="11"><div align="center">TRABAJO A REALIZAR </div></td>
      </tr>
      <tr>
        <td height="80" colspan="11"><label>
          <textarea name="descripcion"  id = "descripcion" cols="90" rows="4"> <?php  echo $datos[0]['observaciones']?>
    </textarea>
        </label></td>
      </tr>
    
	  
	  
   
      <input type="text"  id="idOrdenOculto"  value="<?php   echo $_REQUEST['idorden'];?>">
		  <div id = "nuevodiv">
				 <?php 
         $view->mostrarItemsNuevo($_REQUEST['idorden']);
				?>
		 </div>
	

  <table border = "1">
      <tr>
        <td colspan="7"><div align="center">INVENTARIO</div></td>
      </tr>
      <tr>
        <td width="85">RADIO</td>
        <td width="144">
		<?  if ($datos[0]['radio']=="1"){echo '<input name = "radio" id="radio"  type="checkbox" checked  value = "1" >';} 
		    else {echo '<input  name = "radio" id="radio"  type="checkbox" unchecked   value = "1"  >';}  ?>		</td>
        <td width="199">HERRAMIENTA</td>
        <td colspan="4"><label>
     
		  <?  if ($datos[0]['herramienta']=="1"){echo '<input name = "herramienta" id="herramienta"  type="checkbox" checked value = "1" >';} else {echo '<input  name = "herramienta" id="herramienta"  type="checkbox" unchecked value = "1" >';}  ?>
        </label></td>
      </tr>
      <tr>
        <td>ANTENA</td>
        <td><label><?  if ($datos[0]['antena']=="1"){echo '<input name = "antena" id="antena"  type="checkbox" checked value = "1"  >';} else {echo '<input  name = "antena" id="antena"  type="checkbox" unchecked value = "1" >';}  ?>
        </label></td>
        <td colspan="5" rowspan="2">OTROS
          <label>
            <textarea name="otros" id = "otros" cols="50" rows="2"> <?php  echo $datos[0]['otros']?></textarea>
          </label></td>
      </tr>
      <tr>
        <td>REPUESTO</td>
        <td><label><?  if ($datos[0]['repuesto']=="1"){echo '<input name = "repuesto" id="repuesto"  type="checkbox" checked value = "1" >';} else {echo '<input  name = "repuesto" id="repuesto"  type="checkbox" unchecked value = "1" >';}  ?>
		  
        </label></td>
      </tr>
      <tr>
        <td>IVA</td>
        <td><input name="iva" type="text" id = "iva"  value = "<?php echo $datos[0]['iva']; ?>"</td>
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
        <td colspan="7"><button type ="button"  id = "actualizar_orden" ><h4>ACTUALIZAR_ORDEN</h4></button></td>
      </tr>
    </table>
  </form>

 <h2><a href="../menu_principal.php">Menu Principal</a> <h2>
  
 <a href="index.php">Menu Ordenes</a> 
</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
						//////////////////
			   $("#codigopan").keyup(function(e){
					//$("#cosito").html( $("#nombrepan").val() );
					if (e.which == 13)
					{
							//alert('digito enter');
							var data1 ='codigopan=' + $("#codigopan").val();
							//$.post('buscarelnombre.php',data1,function(b){
							$.post('traer_codigo_descripcion.php',data1,function(b){
							        //  $("#descripan").val() =  descripcion;
									$("#descripan").val(b[0].descripcion);
									$("#valor_unit").val(b[0].valor_unit);
									$("#exispan").val(b[0].existencias);
									$("#cantipan").val('');
									$("#cantipan").focus();
									$("#totalpan").val(0);
							 //(data1);
							},
							'json');
					}// fin del if 		
			   });//finde codigopan
			  
				/////////////////////////////////	
						$("#agregar_item").click(function(){
							var data =  'codigopan =' + $("#codigopan").val();
							data += '&descripan=' + $("#descripan").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantipan=' + $("#cantipan").val();
							data += '&totalpan=' + $("#totalpan").val();
							data += '&exispan=' + $("#exispan").val();
							data += '&orden_numero=' + $("#orden_numero").val();
							$.post('procesar_items.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
              limpiarCamposAgregarItem();

						 });
					///////////////////////////////////
						$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						$('#totalpan').val(resultado2);  
					}	
						
					});
					
					/////////////////////////
					$("#actualizar_orden").click(function(){
							var data =  'orden_numero=' + $("#orden_numero").val();
							data += '&clave=' + $("#clave").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&placa=' + $("#placa").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&radio=' + $("#radio:checked").val();
							data += '&herramienta=' + $("#herramienta:checked").val();
							data += '&antena=' + $("#antena:checked").val();
							data += '&repuesto=' + $("#repuesto:checked").val();
							data += '&otros=' + $("#otros").val();
							data += '&iva=' + $("#iva").val();
							data += '&kilometraje=' + $("#kilometraje").val();
							data += '&mecanico=' + $("#mecanico").val();
							$.post('actualizar_orden.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							$.post('eliminar_items.php',data,function(a){
								$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
			
			function limpiarCamposAgregarItem(){
         document.getElementById("codigopan").value='';
         document.getElementById("descripan").value='';
         document.getElementById("valor_unit").value='';
         document.getElementById("cantipan").value='';
         document.getElementById("totalpan").value='';
      }

			
</script>

