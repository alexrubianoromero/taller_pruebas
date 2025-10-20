	function verificarPlacaInfoCompleta()
	{
        // alert('nueva opcion de verificar');
		var placa =  document.getElementById("placa123").value;
		const http=new XMLHttpRequest();
		const url = '../api/api.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("informacionPropetario").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=verificarPlacaInfoCompleta"
			+ "&placa="+placa
		);
        traerHistorialPlaca(placa);
	}



	function traerHistorialPlaca(placa)
	{
        // alert('nueva opcion de verificar');
		var placa =  document.getElementById("placa123").value;
		const http=new XMLHttpRequest();
		const url = '../api/api.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=traerHistorialPlaca"
			+ "&placa="+placa
		);
	}


