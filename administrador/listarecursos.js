var obj = new RemoteObject('recursos');

//----------------------------------------------------------------------------
function listarecursos_onload(){
	
	
	obj.callMethod('listarRecursos', null, function(lista){
		
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
			editar.innerHTML = '<span class="material-icons" style="cursor:pointer" onclick="load(\'recursos\',\''+lista[f][0]+'\')">edit</span>';
			eliminar.innerHTML = '<span class="material-icons" style="cursor:pointer" onclick="eliminar(\''+lista[f][0]+'\',\''+lista[f][1]+'\')">delete</span>';
			fila.appendChild(editar);
			fila.appendChild(eliminar);
			tabla.appendChild(fila);
		}

	});
}
//----------------------------------------------------------------------------
function eliminar(id,titulo){
	
	if(confirm('Desea eliminar '+ titulo+ '?')){
		//var obj = new RemoteObject('recursos');
		var datos = new FormData();
		datos.append('id',id);
		obj.callMethod('eliminarRecurso', datos, function(result){
			if(result)
				alert('Recurso eliminado');
			else
				alert('El recurso no pudo ser eliminado');
		});
	}
//----------------------------------------------------------------------------
}