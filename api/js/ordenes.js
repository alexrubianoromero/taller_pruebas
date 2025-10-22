function mostrarInfoOrdenNuevo(idOrden)
{

        // alert('nueva opcion de verificar'+idOrden);
		// var placa =  document.getElementById("placa123").value;
		const http=new XMLHttpRequest();
		const url = '../api/ordenes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("modalOrdenesBody").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=mostrarInfoOrdenNuevo"
			+ "&idOrden="+idOrden
			+ "&modificar=0"		
        );
}
function mostrarInfoPropietario(idPropietario)
{

		const http=new XMLHttpRequest();
		const url = '../api/ordenes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("informacionPropetario").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=mostrarInfoPropietario"
			+ "&idPropietario="+idPropietario
        );
}
function mostrarInfoVehiculo(idcarro)
{

		const http=new XMLHttpRequest();
		const url = '../api/ordenes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("informacionVehiculo").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=mostrarInfoVehiculo"
			+ "&idcarro="+idcarro
        );
}
function formuCrearOrdenApiNuevaVersion()
{
        // alert('nueva opcion de verificar'+idOrden);
		var idPlaca=  document.getElementById("idPlacaCrearOrden").value;
		const http=new XMLHttpRequest();
		const url = '../api/ordenes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=formuCrearOrdenApiNuevaVersion"
			+ "&idPlaca="+idPlaca
			// + "&modificar=0"		
        );
}


function crearNuevaOrdenNuevaVersion(idPlaca)
{
        var valida = validarCamposCrearOrden()
		if(valida ==1)
		{

			var kilometraje=  document.getElementById("kilometraje").value;
			var operario=  document.getElementById("operario").value;
			var observaciones=  document.getElementById("observaciones").value;
			const http=new XMLHttpRequest();
			const url = '../api/ordenes.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					//   resp = JSON.parse(this.responseText); 
					//   pantallaMOdificarOrden123(resp);	
					//   alert(resp);
					document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
					// traerHistorialPlaca();
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send(
				"opcion=crearNuevaOrdenNuevaVersion"
				+ "&idPlaca="+idPlaca
				+ "&kilometraje="+kilometraje
				+ "&operario="+operario
				+ "&observaciones="+observaciones
			);
		}
	//mostrar la parte de modificacion de orden 
}


function validarCamposCrearOrden(){
    if(document.getElementById("kilometraje").value == '')
    {
       alert("Digite kilometraje") ;  
       document.getElementById("kilometraje").focus();
       return 0;
    }
    if(document.getElementById("operario").value == '')
    {
       alert("Digite operario") ;  
       document.getElementById("operario").focus();
       return 0;
    }
    if(document.getElementById("observaciones").value == '')
    {
       alert("Digite observaciones") ;  
       document.getElementById("observaciones").focus();
       return 0;
    }
   
	return 1;
}


function pantallaModificarNueva(idorden)
{
		const http=new XMLHttpRequest();
		const url = '../api/ordenes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=pantallaModificarNueva"
			+ "&idorden="+idorden
        );
}
function pantallaMOdificarOrden123(idorden)
{
	// alert('modidifcar orde '+idorden);
	const http=new XMLHttpRequest();
		const url = '../api/ordenes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=pantallaMOdificarOrden123"
				+ "&idorden="+idorden
        );
}