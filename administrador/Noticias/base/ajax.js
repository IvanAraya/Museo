
function RemoteObject(className){	
	this.method = 'POST';
	this.className = className;
	if(!arguments[1])
		this.serverScript = className+'.php';
	else
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
	formData.append("script", this.serverScript);
	formData.append("className", this.className);
	formData.append("method", remoteMethod);
	xhttp.send(formData);
}
