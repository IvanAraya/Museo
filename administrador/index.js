var r = new RemoteObject('index');

function init(){
	
	r.callMethod('getMenu', null, function(m){	
		var menu = document.getElementById('menu-principal');
		for(var i=0; i < m.length; i++){
			var li = document.createElement('li');
			var a = document.createElement('a');
			if(m[i].modulo)
				a.href = 'javascript:load(\''+m[i].modulo+'\')';
			a.innerHTML = m[i].texto;
			li.appendChild(a);
			if(m[i].submenu){
				li.className = 'w3-dropdown-hover';
				var div = document.createElement('div');
				div.className = 'w3-dropdown-content';
				for(var ii=0; ii < m[i].submenu.length; ii++){
					var aa = document.createElement('a');
					aa.innerHTML = m[i].submenu[ii].texto;
					aa.className = 'submenu' ;
					aa.href = 'javascript:load(\''+m[i].submenu[ii].modulo+'\')';
					div.appendChild(aa);
				}
				li.appendChild(div);
			}				
			menu.appendChild(li);
		}

		var li = document.createElement('li');
		var a = document.createElement('a');
		a.href = 'cerrar.php';
		a.innerHTML='Cerrar Sesi&oacute;n';
		li.appendChild(a);
		menu.appendChild(li);

		load('perfil');
	});	
}

function load(modulo){
	var keyValue = '';
	if(arguments[1])
		keyValue = '"'+arguments[1]+'"';
	var xhr;
	if (window.XMLHttpRequest) 
		xhr = new XMLHttpRequest();
	else 
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	xhr.script = document.createElement('script');
	xhr.script.type = 'text/javascript';
	xhr.script.onload = function () { eval(modulo+'_onload('+keyValue+')')};
	xhr.script.src = modulo+'.js';
	xhr.script.id = 'externJS';
	xhr.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200){
			var cuerpo = document.getElementById('cuerpo');								
			cuerpo.innerHTML = this.responseText;				
			var head= document.getElementsByTagName('head')[0];
			if(document.getElementById('externJS'))
				head.removeChild(document.getElementById('externJS'));
			head.appendChild(this.script);
		}
	}
	xhr.open('POST',modulo+'.php', true);
	xhr.send(null);
}

function include(script, callbackFunction){
	if (window.XMLHttpRequest) 
		xhr = new XMLHttpRequest();
	else 
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200){			
			eval(this.responseText);
			callbackFunction();
		}
	}
	xhr.open('POST',script, true);
	xhr.send(null);
}