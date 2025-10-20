<?php


$tabla3 ="cliente0";
$tabla4 ="carros";
$tabla10 = "empresa"; 
$tabla11 = "facturas";
$tabla12 = "productos";
$tabla13 = "item_factura";
$tabla14 = "ordenes";
$tabla15 = "item_orden";
$tabla16 = "usuarios";
$tabla17 = "iva";
$tabla18 = "item_temporal";
$tabla19 = "movimientos_inventario";
$tabla20 = "retefuente";
$tabla21 = "tecnicos";


$tabla30 = "item_temporal_traz";
$tabla31 = "ordenes_traz";

$tabla32 = "querys_traz";
/*
$servidor = "localhost";
$usuario = "root";
$clave  = "peluche2016";
$nombrebase = "base_robertocars";
*/

$servidor = "localhost";
$usuario = "ctwtvsxj_admin";
$clave  = "ElMejorProgramador***";
$nombrebase = "ctwtvsxj_base_robertocars_pruebas";



$conexion =mysql_connect($servidor,$usuario,$clave);
$la_base =mysql_select_db($nombrebase,$conexion);

?>