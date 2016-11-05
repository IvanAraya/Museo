var obj = new RemoteObject('listacatalogo');


function listacatalogo_onload(){
	
	obj.callMethod('cargar_listado', null, function(lista){
		
		var tabla = document.getElementById('tablaLista');		
		for(f=0;f<lista.length;f++){			
			var fila = document.createElement('tr');			
			for(c=0;c<lista[f].length;c++){
				var col = document.createElement('td'); 
				col.innerHTML = lista[f][c];
				fila.appendChild(col);
			}
			var editar = document.createElement('td');
			var eliminar = document.createElement('td');
			/*
			 * para cargar el formulario de 'editar' se usa la funcion load() definida en 'index.js'
			 * esta funcion tiene un argumento obligatorio (el módulo que se está llamando) y un argumento
			 * opcional (el campo clave o ID para identificar el registro que se quiere editar).
			 * ejemplo:
			 * Llamar al modulo usuarios (como en el menu):
			 *
			 *  load('usuarios');
			 *
			 * Llamar al modulo usuarios para editar (asumiendo que el campo clave o ID es el rut):
			 *
			 *  load('usuarios','11.111.111-1');
			 *
			 */
			editar.innerHTML = '<a href="javascript:load(\'catalogo\',\''+lista[f][0]+'\')">edit</a>';
			eliminar.innerHTML = '<a href=#>elim</a>';
			fila.appendChild(editar);
			fila.appendChild(eliminar);
			tabla.appendChild(fila);
		}

	});
	
}