var us = new RemoteObject('usuarios');

function listausuarios_onload()
{
	us.callMethod('listarUsuarios', null, function(lista){
	
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
			editar.innerHTML = '<span class="material-icons" onclick="load(\'usuarios\',\''+lista[f][0]+'\')">edit</span>';
			eliminar.innerHTML = '<span class="material-icons" onclick="eliminarUsuario(\''+lista[f][0]+'\',\''+lista[f][2]+'\')">delete</span>';
			fila.appendChild(editar);
			fila.appendChild(eliminar);
			tabla.appendChild(fila);
		}

	});
}


function eliminarUsuario(rut, nombre)
{
	//alert("eliminate");
	if(confirm('Desea eliminar a '+nombre+'?')){
		var datos = new FormData();
		datos.append('rut',rut);
		us.callMethod('eliminarUsuario', datos, function(respuesta){			
			if(respuesta){
				alert('Usuario eliminado');
				listausuarios_onload();
			}else
				alert('El usuario no pudo ser eliminado');
			//document.getElementById(rut).remove();
		});
	}
}


