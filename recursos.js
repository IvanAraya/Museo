var obj = new RemoteObject('recursos');

function recursos_onload(){
	obj.callMethod('listarRecursos', null, function(lista){
		var tabla = document.getElementById('tablaLista');		
		for(f=0;f<lista.length;f++){			
			var fila = document.createElement('tr');			
			for(c=1;c<lista[f].length-1;c++){
				var col = document.createElement('td'); 
				col.innerHTML = lista[f][c];
				fila.appendChild(col);
			}
			var descargar = document.createElement('td');
			descargar.innerHTML = '<a href="'+lista[f][3]+'"><i class="material-icons" style="font-size:45px">file_download</i></a>';
			fila.appendChild(descargar);
			tabla.appendChild(fila);
		}
	});
}