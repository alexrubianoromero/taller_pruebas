<?php

$raiz = dirname(dirname(__file__));
// die($raiz); 
require_once($raiz.'/api/controllers/vehiculosController.php');  
$vehiculosController = new vehiculosController();
?>