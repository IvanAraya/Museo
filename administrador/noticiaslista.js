var obj = new RemoteObject('noticias');

function noticiaslista_onload(){
	
	obj.callMethod('cargar', null, function(lista){

		var tabla = document.getElementById('tablaLista');	
		for(f=0;f<lista.length;f++){	
			var fila = document.createElement('tr');			
			for(c=1;c<lista[f].length;c++){
				var col = document.createElement('td'); 
				col.innerHTML = lista[f][c];
				fila.appendChild(col);
			}
			var editar = document.createElement('td');
			var eliminar = document.createElement('td');

			editar.innerHTML = '<span class="material-icons" onclick="load(\'noticias\',\''+lista[f][0]+'\')">edit</span>';
			eliminar.innerHTML = '<span class="material-icons" onclick="eliminar(\''+lista[f][0]+'\',\''+lista[f][1]+'\')">delete</span>';
			fila.appendChild(editar);
			fila.appendChild(eliminar);
			tabla.appendChild(fila);
		}
		
	});
	
}

function eliminar(id,titulo){
	
	if(confirm('¿Desea eliminar '+titulo+'?')){
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