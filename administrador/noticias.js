var obj = new RemoteObject('noticias'); //crea un objeto de la clse que se encuentra en el php 

function noticias_onload(){
	
	var id = null;
	if(arguments[0]){
		id = arguments[0] ;
		alert("editar registro: "+id);
	}
	
	var datos = new FormData(document.getElementById('form'));
	datos.append('id',id);
	obj.callMethod('verificar', datos, function(respuesta){
		if(respuesta.b){
			alert("cargando "+respuesta.id);
			document.getElementById("titulo").value = respuesta.titulo;
			document.getElementById("fecha").value= respuesta.fecha;
			document.getElementById("contenido").value = respuesta.contenido;
			//document.getElementById("imagenS").src = "css/subir.jpg";
			document.getElementById("b_eliminar").style.display="inline-block";
		}else{
			document.getElementById("b_eliminar").style.display="none";
		}

	});
}

function subirImagen(){
	alert("subir imagen");

	var datos = new FormData(document.getElementById('form'));
	
	obj.callMethod('subirImagen', datos, 
				function(respuesta){
					document.getElementById("imagenS").src = respuesta.imagen ;
				}
	);

}

function guardar(){	
		var datos = new FormData(document.getElementById('form'));
		obj.callMethod('guardar', datos, function(respuesta){
			alert("Guardado");
			load('noticiaslista');
		});
}

function cancelar(){
		load('noticiaslista');
}

function publicar(){
		var datos = new FormData(document.getElementById('form'));
		obj.callMethod('publicar', datos, function(respuesta){
			alert("Publicado");
		});
}


