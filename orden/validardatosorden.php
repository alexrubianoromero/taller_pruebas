<html>
<head><title>Ingreso de Mecanicos</title>

<BODY BGCOLOR="COCOCO">
<P ALIGN = "CENTER">

<?
include ("../valotablapc.php"); 

$maxima_factura = "select max(idfactura) as numfactura from $tabla11  ";
echo '<hr>'.$maxima_factura.'<hr>';
$consulta_maxfactura = mysql_query($maxima_factura);
$filas  = mysql_num_rows($consulta_maxfactura);
echo '<hr>'.$filas.'<hr>';
//if('');
 $maxfactura = mysql_fetch_assoc($consulta_maxfactura);
 $maxfactura = $maxfactura['numfactura']+1;
 //include ("faconta.php"); 
	//$factupan = $factupan + 1;

?>
     
</P> 

			<P ALIGN = "CENTER">	
		<FORM name=HOJA action=ordencaptura.php method=post>		
		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor=#c0c0c0 border=2>
  			<TBODY>
  			<TR>
   			  <TD>Orden No  
   			    <input size=10 name=ordenpan value=<?echo $maxfactura  ;?>  ></TD>
  			</TR></TBODY></TABLE>
			
			 <?
    $fechapan =  time();
     ?>
			
			

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor=#c0c0c0 border=2>
  <TBODY>
  <TR>
    
    <TD>Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<INPUT size=10 name=fechapan value= <? echo date ( "Y/m/j" , $fechapan );?>> AAAA/MM/DD</TD>
	<td>Placa <?php
								  $link = mysql_connect($servidor,$usuario,$clave);
							if (!$link) {
								die('Imposible establecer conexion : ' . mysql_error());
							}
							 
							// Estableciondo selccion de base de datos
							$db_selected = mysql_select_db($nombrebase, $link);
							if (!$db_selected) {
								die ('bd no selccionada : ' . mysql_error());
							}
							//Consulta para seleccionar lo deseado, en este caso se seleccionara el usuario de la tabla sesion
							$result=mysql_query("SELECT placa FROM $tabla4");
							//Mostramos por un echo la etiqueta del select con su nombre y su id*******
							echo "<select   name='placapan' id='placapan' >";
							//Realizamos un Bucle wile para recorrer la tabla*******
							while ($row=mysql_fetch_array($result))
							{
							//Por otro echo mostramos en cada Option del select lo seleccionado por la consulta***  
							echo '<option value="'.$row['placa'].'">'.$row['placa'].'</option>';
							//Cerramos el Bucle
							}
							//Cerramos el PHP**
							// include("verificarplaca.php");
							 
							?>
</TD>  
	</TR>
  
     <TR>
   
	  
	 
	  <TD><INPUT type=submit value=verificar></TD>
	  </TR></TBODY></TABLE>
	  
	</form>