<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? 
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
$sql_muestre_ordenes = "select id as No_Orden,
fecha,
placa,
id,
orden
 from $tabla14  where id_empresa = '".$_SESSION['id_empresa']."' and tipo_orden < '2'  order by id desc   ";
// die($sql_muestre_ordenes);
$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);

?>
<Div id="contenidos">
		<header>
			<h2>CONSULTA ORDENES </h2>
		</header>
	
<?php
include('../colocar_links2.php');
echo '<table border= "1">';
	echo '<td><h3>No Orden<h3></td><td><h3>Fecha</h3></td><td><h3>Placa</h3></td><td><h3>Accion</h3></td><td><h3>modificar</h3></td><td><h3>Ficha Tecnica </h3></td><td><h3>Vista Impresion</h3></td>'; 
		while($ordenes = mysql_fetch_array($consulta_ordenes))
			{
				echo '<tr>';
				echo '<td><h3>'.$ordenes['4'].'</h3></td><td><h3>'.$ordenes['1'].'</h3></td><td><h3>'.$ordenes['2'].'</h3></td>';
				echo  '<td><h3>';
				echo '<a href="orden_detallado.php?idorden='.$ordenes['0'].'">Ver Detalle</a>';
				echo '</h3></td>'; 
				echo  '<td><h3>';
				echo '<a href="../api/ordenes.php?idorden='.$ordenes['0'].'&opcion=pantallaModificarOrden">Modificar</a>';
				echo '</h3></td>';
				 
				echo  '<td><h3>';
				echo '<a href="orden_detallado_ficha.php?idorden='.$ordenes['0'].'"  target = "_blank">Ficha_Detalle</a>';
				echo '</h3></td>'; 
				echo  '<td><h3>';
				echo '<a href="orden_imprimir.php?idorden='.$ordenes['0'].'"  target = "_blank">Imprimir_Orden</a>';
				echo '</h3></td>'; 
				echo '<tr>';
			}
echo '<table border= "1">';

?>
	</Div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
