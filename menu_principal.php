<?php

session_start();

//echo '<br>idempresa '.$_SESSION['id_empresa'].'<br>';

?>

<!DOCTYPE html>

<html lang="es"  class"no-js">

<head>

	<meta charset="UTF-8">

	<title>Document</title>

	<link rel="stylesheet" href="css/normalize.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body>

<? include("empresa.php"); ?>

<Div id="contenidos">

		<header>

			<h1><? echo $empresa; ?></h1>

			<h2><? echo $slogan; ?><h2>

		</header>

		<nav>

		<ul class="menu">

		   <li><a href="clientes/clientes.php" class="menu">CLIENTES</a></li>

		  <li><a href="vehiculos/carros.php" class="menu">VEHICULOS</a></li>

	    <li><a href="orden/index.php" class="menu">ORDENES DE TRABAJO</a></li>

		  <li><a href="facturas/index.php" class="menu">FACTURAS</a></li>

		

		  <?php

		  /*

		     if ($_SESSION['id_empresa']>30)

		     {}

		     else 	{ echo '<li><a href="ventas/index.php" class="menu">VENTAS</a></li>';}

		     */

		   ?>



		  <li><a href="inventario_codigos/index.php" class="menu">CODIGOS DE INVENTARIO</a></li>


		<li><a href="caja/index.php" class="menu">MODULO DE CAJA</a></li>


		    <?php

		    /*

		     if ($_SESSION['id_empresa']>30)

		     {}

		     else 	{ echo '<li><a href="ayudas_financieras/index.php" class="menu">AYUDAS FINANCIERAS..</a></li>';}

		     */

		   ?>

			<li><a href="consultas/index.php" class="menu">CONSULTAS</a></li>

		



		</ul>

	</nav>

</Div>

	

</body>

</html>

<script src="js/modernizr.js"></script>   

<script src="js/prefixfree.min.js"></script>

<script src="js/jquery-2.1.1.js"></script>   

