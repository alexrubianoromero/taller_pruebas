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




