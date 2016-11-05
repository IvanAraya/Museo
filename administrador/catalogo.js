
function catalogo_onload(){
	/*
	 * El manejador de evento 'formularioX_onload()' se dispara cuando se llama a un form. con la funcion 'load(modulo)'
	 * Este manejador tiene un argumento opcional que corresponde al campo clave o ID del registro que queremos editar
	 * cuando llamamos al form. mediante la funcion 'load(modulo,id)'
	 * Los argumentos opcionales se manejan en javascript con el array 'arguments'
	 */
	
	var id = null;
	if(arguments[0]){
		id = arguments[0] ;
		alert("editar registro: "+id);
	}
	// aqui se hace con el registro lo que sea necesario
	
	 
}