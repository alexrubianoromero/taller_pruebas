<?php

$raiz = dirname(dirname(dirname(__file__)));
// die($raiz);
require_once($raiz.'/api/models/ItemOrdenModel.php');  

class itemOrdenView
{
    protected $model;
    public function __construct()
    {
        $this->model = new ItemOrdenModel();

    }

    public function mostrarItemsNuevo($idOrden)
    {
        ?>
         <!DOCTYPE html>
         <html lang="en">
             <head>
                 <meta charset="UTF-8">
                 <meta name="viewport" content="width=device-width, initial-scale=1.0">
                 <title>Document</title>
                 
                </head>
                <body>
                    <div id="div_principal_parteItems">
                        <table width="679" border = "1">
                            <tr>
                                <td colspan="11"><div align="center">PARTES Y RESPUESTOS**</div></td>
                            </tr>
                            <tr>
                                <td><div align="center">ITEM</div></td>
                                <td><div align="center">COD </div></td>
                                <td><div align="center">DESCRIPCION</div></td>
                                <td><div align="center">VR Unit </div></td>
                                <td>EXIS</td>
                                <td>CANT.</td>
                                <td>TOTAL</td>
                                <td><div align="center"></div></td>
                            </tr>
                            <tr>
                                <td width="34">&nbsp;</td>
                                <td width="38"><label>
                                    <input name="codigopan" type="text" id = "codigopan" size="5" onkeyup="traerLaInfoDelCodigo(event);"/>
                                </label></td>
                                <td width="149"><input type="text" name="descripan" id = "descripan" />
                                <div id = "descripcion"></div></td>
                                <td width="82"><input onkeyup="calcularTotalItem();" type="text" name="valor_unit" id = "valor_unit" size = "10" /></td>
                                <td width="87"><input name="exispan" type="text" id = "exispan" size="10" /></td>
                                <td width="85"><input onkeyup="calcularTotalItem();" name="cantipan" type="text" id = "cantipan"  size ="10"/></td>
                                <td width="77"><input onfocus="blur();"name="totalpan" type="text" id = "totalpan" size="15" /></td>
                                <td width="75"><button type = "button" onclick="agregarItemNuevo();">Agregar</button></td>
                            </tr>
                        </table>
                    </div>   
                    <div id="div_resultados_items_nuevo" class="mt-2">
                        <?php  $this->mostrarSoloItems($idOrden);    ?>
                    </div>
                </body>
                </html>
                <script>
                    function limpiarCampos()
                    {
                         document.getElementById("codigopan").value='';
                         document.getElementById("descripan").value='';
                         document.getElementById("valor_unit").value='';
                         document.getElementById("exispan").value='';
                         document.getElementById("cantipan").value='';
                         document.getElementById("totalpan").value='';
                    }

                    function calcularTotalItem()
                    {
                          var valor_unit =  document.getElementById("valor_unit").value;
                          var cantidad =  document.getElementById("cantipan").value;
                          var resultado = Number(valor_unit) * Number(cantidad);
                          document.getElementById("totalpan").value= resultado;
                    }

                    function agregarItemNuevo(){
                        var valida = verificarCamposNuevoItem();
                        if(valida)
                        {

                            var idOrden =  document.getElementById("idOrdenOculto").value;
                            var codigo =  document.getElementById("codigopan").value;
                            var descripcion =  document.getElementById("descripan").value;
                            var valor_unit =  document.getElementById("valor_unit").value;
                            var cantidad =  document.getElementById("cantipan").value;
                            var totalpan =  document.getElementById("totalpan").value;
                            //  alert(idOrden);
                            const http=new XMLHttpRequest();
                            const url = '../api/api.php';
                            http.onreadystatechange = function(){
                                if(this.readyState == 4 && this.status ==200){
                                    // var  resp = JSON.parse(this.responseText); 
                                    document.getElementById("div_resultados_items_nuevo").innerHTML = this.responseText; ;
                                }
                            };
                            http.open("POST",url);
                            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            http.send("opcion=agregarItemNuevo"
                            +"&idOrden="+idOrden  
                            +"&codigo="+codigo  
                            +"&descripcion="+descripcion  
                            +"&valor_unit="+valor_unit  
                            +"&cantidad="+cantidad  
                            +"&totalpan="+totalpan  
                        );
                        limpiarCampos();
                    }
                }
                
                function eliminarItemNuevaForma(idItem,idOrden)
                {
                         const http=new XMLHttpRequest();
                            const url = '../api/api.php';
                            http.onreadystatechange = function(){
                                if(this.readyState == 4 && this.status ==200){
                                    // var  resp = JSON.parse(this.responseText); 
                                    document.getElementById("div_resultados_items_nuevo").innerHTML = this.responseText; ;
                                }
                            };
                            http.open("POST",url);
                            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            http.send("opcion=eliminarItemNuevaForma"
                            +"&idItem="+idItem  
                            +"&idOrden="+idOrden  
                        );
                         limpiarCampos();
                }
                function traerLaInfoDelCodigo(event)
                {
                    if(event.key==='Enter' || event.key==='Tab' )
                    {
                         var codigo =  document.getElementById("codigopan").value;
                         const http=new XMLHttpRequest();
                            const url = '../api/api.php';
                            http.onreadystatechange = function(){
                                    if(this.readyState == 4 && this.status ==200){
                                            var  resp = JSON.parse(this.responseText); 
                                            // alert(resp.descripcion)
                                            document.getElementById("descripan").value = resp.descripcion;
                                            document.getElementById("valor_unit").value = resp.valor_unit;
                                            document.getElementById("exispan").value = resp.cantidad;
                                            document.getElementById("cantipan").focus();

                                            // document.getElementById("div_resultados_items_nuevo").innerHTML = this.responseText; 
                                        }
                                    };
                                    http.open("POST",url);
                                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    http.send("opcion=traerLaInfoDelCodigo"
                            +"&codigo="+codigo  
                        );
                    }    
                }

                function verificarCamposNuevoItem()
                {
                    if(document.getElementById("codigopan").value == '')
                    {
                        alert("Digite codigo") ;  
                        document.getElementById("codigopan").focus();
                        return 0;
                    }
                    if(document.getElementById("descripan").value == '')
                    {
                        alert("Digite descripcion item") ;  
                        document.getElementById("descripan").focus();
                        return 0;
                    }
                    if(document.getElementById("valor_unit").value == '')
                    {
                        alert("Digite descricion valor unitario") ;  
                        document.getElementById("valor_unit").focus();
                        return 0;
                    }
                    if(document.getElementById("cantipan").value == '')
                    {
                        alert("Digite descricion valor cantidad") ;  
                        document.getElementById("cantipan").focus();
                        return 0;
                    }
                    if(document.getElementById("totalpan").value == '')
                    {
                        alert("Digite descricion valor total item") ;  
                        document.getElementById("totalpan").focus();
                        return 0;
                    }
                return 1;
            }
                
                </script>
        <?php
    }

    public function mostrarSoloItems($idOrden)
    {
        $items = $this->model->traerItemsOrden($idOrden);
        echo '<table width="679"  border = "1" class ="table-bordered">';
        echo '<tr>'; 
            echo '<td width="34" >Item</td>';
            echo '<td width="38">Cod</td>';
            echo '<td width="149">Descripcion</td>';
            echo '<td width="82">VrUnit</td>';
            echo '<td width="87">Cant</td>';
            echo '<td width="85">Total </td>';
            echo '<td width="85">Eliminar</td>';
            echo '</tr>';
            $num =1;
            $total=0;
            foreach($items as $item)
            {
                echo '<tr>'; 
                echo '<td>'.$num.'</td>';
                echo '<td>'.$item['codigo'].'</td>';
                echo '<td >'.$item['descripcion'].'</td>';
                echo '<td align="right">'.number_format($item['valor_unitario'], 0, ',', '.') .'</td>';
                echo '<td>'.$item['cantidad'].'</td>';
                echo '<td align="right">'.number_format($item['total_item'], 0, ',', '.') .'</td>';
                echo '<td><button onclick="eliminarItemNuevaForma('.$item['id_item'].','.$item['no_factura'].');">Eliminar</button></td>';
                echo '</tr>';
                $num = $num +1 ;
                $total = $total + $item['total_item'];
            } 
            echo '<tr>'; 
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td>Total:</td>';
            echo '<td align="right">';  
                echo  number_format($total, 0, ',', '.');
            echo '</td>';
            echo '</tr>';
            echo '</table>';
    }
    public function soloMostrarSoloItems($idOrden)
    {
        $items = $this->model->traerItemsOrden($idOrden);
        echo '<table width="679"  border = "1" class ="table-bordered">';
        echo '<tr>'; 
            echo '<td width="34" >Item</td>';
            echo '<td width="38">Cod</td>';
            echo '<td width="149">Descripcion</td>';
            echo '<td width="82">VrUnit</td>';
            echo '<td width="87">Cant</td>';
            echo '<td width="85">Total </td>';
            echo '</tr>';
            $num =1;
            $total=0;
            foreach($items as $item)
            {
                echo '<tr>'; 
                echo '<td>'.$num.'</td>';
                echo '<td>'.$item['codigo'].'</td>';
                echo '<td >'.$item['descripcion'].'</td>';
                echo '<td align="right">'.number_format($item['valor_unitario'], 0, ',', '.') .'</td>';
                echo '<td>'.$item['cantidad'].'</td>';
                echo '<td align="right">'.number_format($item['total_item'], 0, ',', '.') .'</td>';
                // echo '<td><button onclick="eliminarItemNuevaForma('.$item['id_item'].','.$item['no_factura'].');">Eliminar</button></td>';
                echo '</tr>';
                $num = $num +1 ;
                $total = $total + $item['total_item'];
            } 
            echo '<tr>'; 
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td>Total:</td>';
            echo '<td align="right">';  
                echo  number_format($total, 0, ',', '.');
            echo '</td>';
            echo '</tr>';
            echo '</table>';
    }

}

?>