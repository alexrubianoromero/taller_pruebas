<?php
/*6fdf5*/

/* infection cleaned: include_home_favicon */

/*6fdf5*/
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? include("../empresa.php"); ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
		<nav>
		<ul class="menu">
	    <!-- <li><a href="muestreplacas2.php" class="menu">CREAR ORDEN DE TRABAJO</a></li> -->
	    <li><a href="../api/ordenes.php?opcion=formuCreacionNuevaOrden" class="menu">CREAR ORDEN DE TRABAJO</a></li>
		  <li><a href="muestre_orden.php" class="menu">CONSULTAR ORDENES</a></li>
		   <li><a href="../consultas/pregunte_placa.php" class="menu">CONSULTAR ORDENES NUEVA OPCION</a></li>
		   <li><a href=../menu_principal.php   class="menu"  >MENU PRINCIPAL</a></li>
		

		</ul>
	</nav>
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
