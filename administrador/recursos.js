var obj = new RemoteObject('recursos');
var nuevoRecurso;
var id = null;

function recursos_onload(){
	if(arguments[0]){
		nuevoRecurso = false;
		id = arguments[0];
		titulo_formulario.innerHTML = "Editar Recurso";
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
		id = null;
		titulo_formulario.innerHTML = "Agregar Nuevo Recurso";
		document.getElementById("boton_eliminar").disabled = true;
	}
}

function mostrarNombre(){
	document.getElementById("campo_archivo").value = document.getElementById("cargar").value.replace("C:\\fakepath\\", "");
}

function escribirBD(){
	var llamada_metodo;
	var cambiarRecurso = 0;
	
	if(nuevoRecurso){
		llamada_metodo = 'agregarRecurso';
	}
	else{
		llamada_metodo = 'editarRecurso';
	}
	
	if(document.getElementById('cargar').files.length > 0){
		cambiarRecurso = 1;
	}
	
	var datos = new FormData(document.getElementById('formulario_recursos'));
	datos.append('id',id);
	datos.append('cambiar',cambiarRecurso);
	obj.callMethod(llamada_metodo, datos, function(respuesta){
		if(respuesta){
			alert("Recurso guardado");
			load('listarecursos');
		}
		else{
			alert("ERROR - No se pudo guardar el recurso");
		}
	});
}

function cancelarRecurso(){
	if(confirm('Desea cancelar? Los datos no guardados se perderan')){	
		load('listarecursos');
	}
}

function eliminar(){
	if(confirm('Desea eliminar este recurso?')){
		var datos = new FormData(document.getElementById('formulario_recursos'));
		datos.append('id',id);
		obj.callMethod('eliminarRecurso', datos, function(result){
			if(result){
				alert('Recurso eliminado');
				load('listarecursos');
			}
			else{
				alert('ERROR - No se pudo eliminar el recurso');
			}
		});
	}
}