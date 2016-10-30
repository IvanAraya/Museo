
function RemoteObject(className){	
	this.method = 'POST';
	this.className = className;
	this.serverScript = '';
	if(arguments[1])
		this.serverScript = arguments[1];
}
RemoteObject.prototype.callMethod = function(remoteMethod, formData, callbackFunction){
	var xhttp;
	if (window.XMLHttpRequest) 
		xhttp = new XMLHttpRequest();
	else 
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
			try{
				objeto_json =  JSON.parse(this.responseText) ;
				callbackFunction(objeto_json);
			}
			catch(err){
				respuesta_json =  this.responseText.replace(/<[^>]+>/g,'') ;
				alert("Se ha producido un error:\nPor favor contactese con el administrador del sistema.\n" +respuesta_json) ;
				return false;
			}
		}
    }
	xhttp.open(this.method, 'base/ajax.php', true);
	if(!formData)
		formData = new FormData();
	formData.append("0", this.serverScript);
	formData.append("1", this.className);
	formData.append("2", remoteMethod);
	xhttp.send(formData);
}
