var f = new RemoteObject('recursos');
var nuevoRecurso;

function recursos_onload(){
	//alert(arguments[0]);
	if(arguments[0]){
		nuevoRecurso = false;
		editarRecurso(arguments[0]);
		document.getElementById("boton_eliminar").disabled = false;
		var datos = new FormData();
		datos.append('id',arguments[0]);		
		obj.callMethod("cargarRecurso",datos,function(arreglo){
			document.getElementById("campo_titulo").value = arreglo.titulo;
			document.getElementById("campo_descripcion").value = arreglo.descripcion;
			document.getElementById("campo_archivo").value = arreglo.archivo;
		});
	}
	else{
		nuevoRecurso = true;
		agregarRecurso(arguments[0]);
		document.getElementById("boton_eliminar").disabled = true;
	}
}

function mostrarNombre(){
	document.getElementById("campo_archivo").value = document.getElementById("cargar").value;
}

function agregarRecurso(){
	/*
	var datos = new FormData();
	datos.append('id',id);
	f.callMethod("agregarRecurso", datos, function(respuesta){
		if(respuesta){
			alert('Recurso agregado');
			load('listarecursos');
		}
		else
			alert('ERROR - No se pudo agregar el recurso');
		});
	*/
}

function editarRecurso(){
	
	/*
	var datos = new FormData();
	datos.append('id',id);
	f.callMethod("editarRecurso", datos, function(respuesta){
		if(respuesta){
			alert('Recurso agregado');
			load('listarecursos');
		}
		else
			alert('ERROR - No se pudo agregar el recurso');
		});
	*/
}

function cancelarRecurso(){
	if(confirm('Desea cancelar? Los datos no guardados se perderan')){	
		load('listarecursos');
	}
}

function eliminarRecurso(){
	if(confirm('Desea eliminar este recurso?')){
		var datos = new FormData();
		datos.append('id',id);
		f.callMethod("eliminarRecurso", datos, function(respuesta){
			if(respuesta){
				alert('Recurso eliminado');
				load('listarecursos');
			}
			else
				alert('ERROR - No se pudo eliminar el recurso');
		});
	}
}