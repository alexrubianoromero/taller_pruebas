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
     
		const http=new XMLHttpRequest();
		const url = '../api/clientes.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
				//  pantallaFormuVehiculo(idCliente);
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=escogerClienteApi"
			+ "&idCliente="+idCliente
		);
	}




	function registrarCLienteNUevoApi()
	{
        // alert('nueva opcion de verificar');
		var verifica = verificaInfoLCienteApi();
		if(verifica)
		{

			var identi =  document.getElementById("identi").value;
			var nombre =  document.getElementById("nombre").value;
			var telefono =  document.getElementById("telefono").value;
			var direccion =  document.getElementById("direccion").value;
			var email =  document.getElementById("email").value;
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
				"opcion=registrarCLienteNUevoApi"
				+ "&identi="+identi
				+ "&nombre="+nombre
				+ "&telefono="+telefono
				+ "&direccion="+direccion
				+ "&email="+email
			);
		} 
	}

	function verificaInfoLCienteApi()
	{
		    if(document.getElementById("identi").value == '')
			{
			alert("Digite identidad") ;  
			document.getElementById("identi").focus();
			return 0;
			}
			if(document.getElementById("nombre").value == '')
			{
			alert("Digite nombre") ;  
			document.getElementById("nombre").focus();
			return 0;
			}
			if(document.getElementById("telefono").value == '')
			{
			alert("Digite telefono") ;  
			document.getElementById("telefono").focus();
			return 0;
			}
			if(document.getElementById("direccion").value == '')
			{
			alert("Digite direccion") ;  
			document.getElementById("direccion").focus();
			return 0;
			}
			if(document.getElementById("email").value == '')
			{
			alert("Digite email") ;  
			document.getElementById("email").focus();
			return 0;
			}
		
			return 1;
	}
