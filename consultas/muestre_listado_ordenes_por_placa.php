<?php
session_start();
?>
<!DOCTYPE html>
<html >
<!-- <html lang="es"  class"no-js">
-->

<head>
<meta charset="UTF-8">
<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
<? 
include('../colocar_links2.php');
include('../valotablapc.php');

$sql_listado_ordenes = "select id,fecha,orden from $tabla14 where placa = '".$_POST['placa123']."' and id_empresa = '".$_SESSION['id_empresa']."' ";



//echo '<br>'.$sql_listado_ordenes;
$consulta_ordenes = mysql_query($sql_listado_ordenes,$conexion);
echo '<H2>LISTADO DE ORDENES DE LA PLACA   </H2'.'<h2>'.$_POST['placa123'].'</h2>';
echo '<div id = "mostrar">';


echo '<table border = "1" align="center">';
while($ordenes = mysql_fetch_array($consulta_ordenes))
{
	 echo '<tr>';
	 echo '<td><h2>'.$ordenes[2].'<h2></td><td><h2><a href="../orden/orden_detallado.php?idorden='.$ordenes[0].' ">'.$ordenes[1].'</a></h2></td>';
	  echo '</tr>';
}
echo '</table>';
echo '<div>';
?>	

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>

