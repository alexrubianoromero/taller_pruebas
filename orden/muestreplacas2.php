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
include('../valotablapc.php');
//limpiar las tablas temporales 


$sql_carros ="select idcarro,placa from $tabla4";
$consulta_placas = mysql_query($sql_carros,$conexion);
?>
<Div id="contenidos">
		<header>
			<h2>POR FAVOR ESCOJA LA PLACA </h2>
		</header>


	<table width="700" border="1">
  <tr>
    <td width="310"><h2>PLACA</h2></td>
    <td width="144"><h2>
		<input type="hidden" id ="indVerifPlaca" value=0>
		<div id="divInfoPlaca"></div>
      <input type="text"  id = "placa123" name="textfield" onkeyup="verifiquePlaca();">
    </h2></td>
    <td width="124"><h2>
      <label>    </label>
    </h2></td>
  </tr>
  <tr>
    <td> <button type ="button"  id = "crear_orden"  ><h3>SIGUIENTE</h3></button></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="87" colspan="3"><h2><label  for="casilla_carros" > NUEVA PLACA </label> 
	<input type="checkbox" name="casilla_carros" id = "casilla_carros"  value="checkbox" /></h2></td>
    </tr>
  <tr>
    <td height="87" colspan="3"><?php  include('../colocar_links2.php');  ?></td>
  </tr>
</table>

	
</Div>

<div id = "carros123">
</div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>

<script language="JavaScript" type="text/JavaScript">

	function verifiquePlaca()
	{
		var placa =  document.getElementById("placa123").value;
		const http=new XMLHttpRequest();
		const url = '../api/api.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
				var  resp = JSON.parse(this.responseText); 
				document.getElementById("indVerifPlaca").value = resp.filas;
				if(resp.filas == 0)
				{
					document.getElementById("divInfoPlaca").innerHTML  = 'No existe placa!!!';
				}
				else{
					document.getElementById("divInfoPlaca").innerHTML  = 'Propietario: '+resp.nombre;

				}
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=verificarPlaca"
			+ "&placa="+placa
		);
	}

					
	
    function creacionOrdenNuevaForma(placa){
        const http=new XMLHttpRequest();
        const url = '../api/api.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
				var  resp = JSON.parse(this.responseText); 
				// $(window).attr('location', 'orden_modificar.php?idorden='+resp);
				$(window).attr('location', '../api/ordenes.php?idorden='+resp+'&opcion=pantallaModificarOrden');
				// echo '<a href="../api/ordenes.php?idorden='.$ordenes['0'].'&opcion=pantallaModificarOrden">Modificar</a>';
				
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=creacionOrdenNuevaForma"
            +"&placa="+placa  
        );
    }
            
$(document).ready(function(){
               
			   /*
			    $("#empresapan").change(function(event){
                    var cod = $("#empresapan").find(':selected').val();
                    $("#resultados").load('muestre_datos_cliente.php?cod='+cod );
                });
				*/
	
						///////////////////////
			           ///////////////////////
				
				
				///////////////////////////////////
				
					$("#casilla_carros").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										 $("#carros123").load('pregunte_datos_nuevo_carro.php');
										//alert('Se hizo check en el checkbox.');
							  
							  
							  	} else {
										//alert('Se destildo el checkbox');
										$("#carros123").html('');
							  }	  
					  });
					  //////////////////////////
					  
					  $("#crear_orden").click(function(){

							    
								if($("#indVerifPlaca").val()== 0)
								{
									alert('No se puede crear la orden placa no existe');
									
								}else{
									// cree la orden y asignelo  y envieselo al orden captura
									//una funcion que vaya mire como va el contador creer la orden y le sume 1 a eso

									var placa123 =$("#placa123").val();
									 creacionOrdenNuevaForma(placa123);
										// $(window).attr('location', 'ordencaptura.php?placa123='+placa123);

								}

					  });	

					
});			
          	
</script>