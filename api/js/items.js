function agregarItemNuevo()
{
    alert('agregar item');
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