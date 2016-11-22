
var remote = new RemoteObject("perfil");
var rut = null;

function perfil_onload(){
	remote.callMethod('obtenerDato', null, function(respuesta)
	{
		document.getElementById("rut").innerHTML = respuesta.rut+"-"+respuesta.dv;
		document.getElementById("nombre").innerHTML = respuesta.nombre+" "+respuesta.apellido;
		document.getElementById("email").value = respuesta.mail;
		document.getElementById("nuevaPass").value = "";
		rut = respuesta.rut;
		//alert(nombre);
	});


}

function guardarPass()
{
	nuevaPass = document.getElementById("nuevaPass").value;
	confPass = document.getElementById("confPass").value;
	email = document.getElementById("email").value;

	if (nuevaPass == confPass)
	{
		//alert(rut);
		var arr =[];
		arr[0] = rut;
		arr[1] = confPass;
		arr[2] = email;

		var jsonarr = JSON.stringify(arr);
	
		var arg = new FormData();
		arg.append('datos',jsonarr);
		
		remote.callMethod("guardarDatos", arg, function(respuesta){
			if(respuesta)
			{
				alert("Usuario guardado con exito");
				load('perfil');
			}
			else
				alert("No se pudo actualizar los datos");
		});


	}
	else{
		alert("Error: las contraseñas no coinciden");
		document.getElementById("nuevaPass").value = "";
		document.getElementById("confPass").value = "";
		document.getElementById("nuevaPass").focus();

	}

}

/*function boton(){
	
	alert('hola boton');
}*/