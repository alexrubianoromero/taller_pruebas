<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/


include('../valotablapc.php');

$sql_grabar_carro = "insert into $tabla4  (placa,marca,tipo,modelo,color,propietario,id_empresa) 
values (
'".$_POST['placa']."',
'".$_POST['marca']."',
'".$_POST['tipo']."',
'".$_POST['modelo']."',
'".$_POST['color']."',
'".$_POST['idcliente']."',
'".$_SESSION['id_empresa']."'

)

";
$consulta_grabar_carros = mysql_query($sql_grabar_carro,$conexion);



?>