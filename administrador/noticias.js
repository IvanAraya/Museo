var obj = new RemoteObject('noticias'); //crea un objeto de la clse que se encuentra en el php 
var nuevaNoticia ;
var id = null;

function noticias_onload(){
	if(arguments[0]){
		id = arguments[0] ;
		nuevaNoticia = false;
	}else{
		id = null;
		nuevaNoticia = true;
	}
	var datos = new FormData(document.getElementById('form'));
	datos.append('id',id);
	obj.callMethod('verificar', datos, function(respuesta){
		if(respuesta.b){
			document.getElementById("titulo").value = respuesta.titulo;
			document.getElementById("fecha").value= respuesta.fecha;
			document.getElementById("contenido").value = respuesta.contenido;
			//document.getElementById("imagenS").src = "css/subir.jpg";
			document.getElementById("b_eliminar").style.display="inline-block";

			if(respuesta.publicado==0)
				document.getElementById("publicar").checked = false;
			else
				document.getElementById("publicar").checked = true;

			


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
	var verificar=true;
	//------------------------------------------------------
	if(document.getElementById("titulo").value == "" || document.getElementById("contenido").value == "" )
	{
		verificar=false;
	}
	//------------------------------------------------------/
	if(verificar){
		var metodo;
		var check;
		if(nuevaNoticia)
			metodo = 'guardar';
		else
			metodo = 'actualizar';

			
		if(document.getElementById("publicar").checked)
			check=1;
		else
			check=0;
		


		var datos = new FormData(document.getElementById('form'));
		datos.append('id',id);
		datos.append('check',check);
		obj.callMethod(metodo, datos, function(respuesta){
			if(respuesta){
				alert("Guardado");
				load('noticiaslista');
			}else
				alert("No se pudo guardar la noticia");
		});
	}else{
		alert("Debe llenar todos los campos");
	}	
}
	

function cancelar(){
		load('noticiaslista');
}

function publicar(){

	var verificar=true;
	//------------------------------------------------------
	if(document.getElementById("titulo").value == "" || document.getElementById("contenido").value == "" )
	{
		verificar=false;
	}
	//------------------------------------------------------/
	if(verificar){
		var metodo;
		if(nuevaNoticia)
			metodo = 'publicar';
		else
			metodo = 'actualizarypublicar';
			
		var datos = new FormData(document.getElementById('form'));
		datos.append('id',id);
		obj.callMethod(metodo, datos, function(respuesta){
			if(respuesta){
				alert("Guardado");
				load('noticiaslista');
			}else
				alert("No se pudo publicar la noticia");
		});
	}else{
		alert("Debe llenar todos los campos");
	}	
}

		

function eliminar(){
	
	if(confirm('¿Esta seguro que desea eliminar la noticia?')){
		var datos = new FormData();
		datos.append('id',id);
		obj.callMethod('eliminarNoticia', datos, function(respuesta){			
			if(respuesta){
				alert('Actividad eliminada');
				//noticiaslista_onload();
				load('noticiaslista');
			}else
				alert('La actividad no pudo ser eliminada');
		});
	}
}

