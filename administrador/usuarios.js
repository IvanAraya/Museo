var f = new RemoteObject('Usuarios');



function editarUsuario(rut)
{
	//alert("editate");
	var datos = new FormData();
	datos.append('rut',rut);
	f.callMethod("enviarInfo", datos, function(respuesta){
		document.getElementById("Erut").value = rut+"-"+respuesta[0];
		document.getElementById("Enombre").value = respuesta[1];
		document.getElementById("Eapellido").value = respuesta[2];
		document.getElementById("Epass").value = respuesta[3];
		document.getElementById("Email").value =respuesta[4];
		
		if(respuesta[5] == 1)
			document.getElementById("AS").checked= true;
		else
			document.getElementById("AS").checked= false;

		if(respuesta[6] == 1)
			document.getElementById("EC").checked= true;
		else
			document.getElementById("EC").checked= false;

		if(respuesta[7] == 1)
			document.getElementById("EAR").checked= true;
		else
			document.getElementById("EAR").checked= false;

		if(respuesta[8] == 1)
			document.getElementById("ER").checked= true;
		else
			document.getElementById("ER").checked= false;
		
	});
}

function eliminarUsuario(rut)
{
	alert("eliminate");
	var datos = new FormData();
	datos.append('rut',rut);
	f.callMethod("eliminarUsuario", datos, function(respuesta){
		alert(respuesta);
	});
}

function agregarUsuario()
{

}