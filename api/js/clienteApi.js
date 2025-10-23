	function pantallaCrearEscojerCliente()
	{
        // alert('nueva opcion de verificar');
		// var idPlaca =  document.getElementById("idPlacaCrearOrden").value;
		const http=new XMLHttpRequest();
		const url = '../api/clientes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("informacionPropetario").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=pantallaCrearEscojerCliente"
			// + "&idPlaca="+idPlaca
		);
	}
	function fomularioNuevoCLiente()
	{
        // alert('nueva opcion de verificar');
		// var idPlaca =  document.getElementById("idPlacaCrearOrden").value;
		const http=new XMLHttpRequest();
		const url = '../api/clientes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=fomularioNuevoCLiente"
			// + "&idPlaca="+idPlaca
		);
	}
    
	function buscarNombreLCienteApiCLientes()
	{
        // alert('nueva opcion de verificar');
		var nombre =  document.getElementById("buscarNombreCLiente").value;
		const http=new XMLHttpRequest();
		const url = '../api/clientes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("traerclientesFiltros").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=buscarNombreLCienteApiCLientes"
			+ "&nombre="+nombre
		);
	}
	function escogerClienteApi(idCliente)
	{
        // alert('nueva opcion de verificar');
		// var nombre =  document.getElementById("buscarNombreCLiente").value;
		const http=new XMLHttpRequest();
		const url = '../api/clientes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
				 pantallaFormuVehiculo(idCliente);
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=buscarNombreLCienteApiCLientes"
			+ "&idCliente="+idCliente
		);
	}
