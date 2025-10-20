<?php

$raiz = dirname(dirname(__file__));
// die($raiz); 
require_once($raiz.'/api/controllers/apiController.php');  
$apiController = new apiController();
?>