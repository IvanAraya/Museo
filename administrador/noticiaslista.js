var obj = new RemoteObject('noticiaslista');

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
			editar.innerHTML = '<a href="javascript:load(\'noticias\',\''+lista[f][0]+'\')">edit</a>';
			eliminar.innerHTML = '<a href=#>elim</a>';
			fila.appendChild(editar);
			fila.appendChild(eliminar);
			tabla.appendChild(fila);
		}
		
	});
	
}