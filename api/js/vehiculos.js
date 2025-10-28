	function verificarPlacaInfoCompleta()
	{
        // alert('nueva opcion de verificar');
		var placa =  document.getElementById("placa123").value;
		const http=new XMLHttpRequest();
		const url = '../api/api.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
				  var  resp = JSON.parse(this.responseText); 
                if(resp.filas >0)
                {  
					// alert(resp.filas);  
					// document.getElementById("infoBusquedaPlaca").textContent = 'Vehiculo existe';
					document.getElementById("indVerifPlaca").value= resp.filas;
					document.getElementById("idPlacaCrearOrden").value= resp.datos.idcarro;
					document.getElementById("divBotonesSiExsite").classList.remove('d-none');
					document.getElementById("infoBusquedaPlaca").textContent = '';
					mostrarInfoPropietario(resp.idPropietario);
					mostrarInfoVehiculo(resp.datos.idcarro);
				}else {
					document.getElementById("infoBusquedaPlaca").textContent = 'No hay Info de este Vehiculo ';
					document.getElementById("indVerifPlaca").value= 0;
					document.getElementById("idPlacaCrearOrden").value= 0;
					document.getElementById("divBotonesSiExsite").classList.add('d-none');
					 document.getElementById("informacionPropetario").innerHTML  = '';
					 document.getElementById("informacionVehiculo").innerHTML  = '';
					 document.getElementById("divHistorialPlaca").innerHTML  = '';
					 //debe preguntar la info del propietario
					 pantallaCrearEscojerCliente();

				}
                //  document.getElementById("informacionPropetario").innerHTML  = this.responseText;
				 //si la placa existe debe colar el id en algun input 

			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=verificarPlacaInfoCompleta"
			+ "&placa="+placa
		);

        // traerHistorialPlaca(idPlaca);
	}



	function traerHistorialPlaca()
	{
        // alert('nueva opcion de verificar');
		var idPlaca =  document.getElementById("idPlacaCrearOrden").value;
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
			+ "&idPlaca="+idPlaca
		);
	}
	function registrarVehiculoNuevoApi()
	{
		var valida = validarCamposCrearVehiculo();
		if(valida)
		{

			// alert('llega a al vehiculos js123');
			var idCliente =  document.getElementById("idCliente").value;
			var placa =  document.getElementById("placa").value;
			var marca =  document.getElementById("marca").value;
			var tipo =  document.getElementById("tipo").value;
			var modelo =  document.getElementById("modelo").value;
			var color =  document.getElementById("color").value;
			const http=new XMLHttpRequest();
			const url = '../api/vehiculos.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
					//aqui podria utilizar las funciones 
					//recibiendo la info por ajax de
					//  mostrarInfoPropietario(resp.idPropietario);
					// 	mostrarInfoVehiculo(resp.datos.idcarro);
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send(
				"opcion=registrarVehiculoNuevoApi"
				+ "&idCliente="+idCliente
				+ "&placa="+placa
				+ "&marca="+marca
				+ "&tipo="+tipo
				+ "&modelo="+modelo
				+ "&color="+color
			);
			//llamar una funcion que me devuelva la info del ultimo vehiculo grabado
			//y con base en eso pinte la info de cliente y vehiculo
			// mostrarInfoPropietario(idPropietario);
			// mostrarInfoVehiculo(idPlaca);
		}

	}
	function validarCamposCrearVehiculo()
	{
			if(document.getElementById("placa").value == '')
			{
				alert("Digite placa") ;  
				document.getElementById("placa").focus();
				return 0;
			}
		
			if(document.getElementById("marca").value == '')
			{
				alert("Digite marca") ;  
				document.getElementById("marca").focus();
				return 0;
			}

			if(document.getElementById("tipo").value == '')
			{
				alert("Digite tipo") ;  
				document.getElementById("tipo").focus();
				return 0;
			}
			if(document.getElementById("color").value == '')
			{
				alert("Digite color") ;  
				document.getElementById("color").focus();
				return 0;
			}
			if(document.getElementById("modelo").value == '')
			{
				alert("Digite modelo") ;  
				document.getElementById("modelo").focus();
				return 0;
			}
			
		
			return 1;
	}

	function pantallaFormuVehiculo(idCliente)
	{
		// alert('pantalla fomru vehiculo js');
		const http=new XMLHttpRequest();
		const url = '../api/vehiculos.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=pantallaFormuVehiculo"
			+ "&idCliente="+idCliente
		);
	}

	function formuCreacionVehiculoIdCliente(idCliente)
	{
		// alert('pantalla fomru vehiculo js');
		const http=new XMLHttpRequest();
		const url = '../api/vehiculos.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
                 document.getElementById("divHistorialPlaca").innerHTML  = this.responseText;
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(
			"opcion=formuCreacionVehiculoIdCliente"
			+ "&idCliente="+idCliente
		);
	}




