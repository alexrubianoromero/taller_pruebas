
<?php

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

// esta funcion la utilizo cuando se va a facturar por esto ya tiene un formato predefinido para que cuadre al momento de mostrar la factura e imprimirla 
function muestre_items($orden,$tabla,$conexion,$id_empresa)
		{
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			echo '<tr>
			     
                <td width="38"><h7>'.$items['codigo'].'</h7></td>
    			<td width="60" colspan = "4"><h7> '.$items['descripcion'].'</h7></td>
				<td width="87"><h7><div align = "right"> '.$items['cantidad'].'</div></h7></td>
    			<td width="82"><h7><div align = "right">'.$items['valor_unitario'].'</div></h7></td>
   			    <td width="85"><h7><div align = "right">'.$items['total_item'].'</div></h7></td>
					</tr>
				';
				//<td width="34">'.$i.'</td>
				$subtotal = $subtotal + $items['total_item'];
			 }
			 return $subtotal; 
		}
///////////////////////////
//function actualizar_inventario()

function maximo_valor($campo,$conexion,$tabla,$idempresa)
		 {
		 		$sql_valor ="select $campo as valor  from $tabla  where id_empresa =  '".$idempresa."'   ";
		 		//echo '<br>'.$sql_valor.'<br>';
		 		$maximo_valor  = mysql_query($sql_valor,$conexion);
		 		$maximo_valor = mysql_fetch_assoc($maximo_valor); 
		  		return $maximo_valor['valor'];
		 } 	

function regimen ($id_empresa,$tabla,$conexion)
		{
				$sql_regimen = "select regimen  from $tabla  where id_empresa = '".$id_empresa."' ";
				//echo '<br>'.$sql_regimen.'<br>';
				$regimen = mysql_query($sql_regimen,$conexion);
				$regimen = mysql_fetch_assoc($regimen);
				return $regimen['regimen']; 

		}

function pasar_items_temporal_definitivo ($numero,$id_orden,$conexion,$tabla_temporal,$tabla_definitiva,$tabla_codigos )
			{
						///////////////////////////////////////
						$sql_traer_items_temporal = "select * from $tabla_temporal   where  no_factura =  '".$numero."'   and id_empresa = '".$_SESSION['id_empresa']."' order by id_item ";
						$consulta_temporal_definitivo = mysql_query($sql_traer_items_temporal,$conexion);
						while($items  =  mysql_fetch_array($consulta_temporal_definitivo))
								{

									//echo '<br>'.$items[3];
									$sql_grabar_items = " insert into $tabla_definitiva   (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado) 
									values ('".$id_orden."','".$items[2]."','".$items[3]."','".$items[4]."','".$items[5]."','".$items[7]."','".$items[8]."','0')";
									$consulta_trasladar_item = mysql_query($sql_grabar_items,$conexion);
									//falta actualizar los valores de inventario;
									//tengo que traer el valor existente en la base 
									$sql_valor_existente = "select codigo_producto,cantidad from $tabla_codigos where codigo_producto =  '".$items[2]."'   and id_empresa = '".$_SESSION['id_empresa']."'    ";	
									//echo '<br>'.$sql_valor_existente;
									$consulta_valor_inventario = mysql_query($sql_valor_existente,$conexion); 
									$valor_actual_inventario = mysql_fetch_assoc($consulta_valor_inventario);
									$valor_final_inventario = $valor_actual_inventario['cantidad']  -  $items[4];
									

									$sql_actualizar_inventario = "update $tabla_codigos set cantidad = '".$valor_final_inventario."'   
											 where codigo_producto = '".$items[2]."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
											
						      		//echo '<br>consulta '.$sql_actualizar_inventario;

									$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);  

									///////////////////


								} // temina el proceso de los items
						///////////////////////////////////////////////////////////
								
						//////////////////////////////////////

								
			}// fin de la funcion pasar_items_temporal_definitivo

 function borrar_items_temporal($numero,$conexion,$tabla_temporal)
           			{
					            $sql_borrar_temporal = "delete from $tabla_temporal where id_empresa = '".$_SESSION['id_empresa']."' and no_factura = '".$numero."' ";
								$consulta_borrar = mysql_query($sql_borrar_temporal,$conexion);	
					}		


?>