
var remote = new RemoteObject("perfil");

function perfil_onload(){
	alert("hola");
	remote.callMethod('obtenerDato', null, function(respuesta)
	{
		nombre = respuesta.nombre;
		alert(nombre);
	});
}

/*function boton(){
	
	alert('hola boton');
}*/