
<?php
$servidor = "localhost";
$usuario = "root";
$pass = "peluche";
$db = "freedom";
function consultar_mysql($db,$sql_query)
    {
    //$conexion = mysql_connect("cobog10-01-160", "prodmygdmti", "p27052011d");
	$conexion = mysql_connect($servidor,$usuario,$pass);
	
    mysql_select_db($db,$conexion);
    $rs = mysql_query($sql_query,$conexion) or die(mysql_error());
    return $rs;
    }


function get_table_assoc($datos)
		{
		 				$arreglo_assoc='';
							$i=0;	
							while($row = mysql_fetch_assoc($datos)){		
								$arreglo_assoc[$i] = $row;
								$i++;
							}
						return $arreglo_assoc;
		}
function draw_table($datos)
					{
					
								echo '<table border = "1">';
									$titulos = array_keys($datos[0]);
										echo '<tr>';
										foreach   ($titulos as $d ) { 
											echo "<td>".strtoupper($d)."</TD>"; 
										} 
										
										
										echo '</tr>';
										foreach   ($datos as $d ) {   
											echo '<tr>';
											foreach   ($d as $r ) {
											echo "<td>$r</TD>";
											}
											echo '</tr>';		
										}
										echo '</table>';

					
					}
?>