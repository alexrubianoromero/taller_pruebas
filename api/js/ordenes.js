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
