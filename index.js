var r = new RemoteObject('index');

function init(){
	
	load('home','Home');

}

function load(modulo, titulo){
	var xhr;
	if (window.XMLHttpRequest) 
		xhr = new XMLHttpRequest();
	else 
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	xhr.script = document.createElement('script');
	xhr.script.type = 'text/javascript';
	xhr.script.onload = function () { eval(modulo+'_onload()')};
	xhr.script.src = modulo+'.js';
	xhr.script.id = 'externJS';
	xhr.titulo = titulo;
	xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
				var cuerpo = document.getElementById('cuerpo');								
				cuerpo.innerHTML = this.responseText;				
				var head= document.getElementsByTagName('head')[0];
				if(document.getElementById('externJS'))
					head.removeChild(document.getElementById('externJS'));
				head.appendChild(this.script);
				var titulo = document.getElementById('pageName');
				titulo.innerHTML=this.titulo;
		}
	}
	xhr.open('POST',modulo+'.php', true);
	xhr.send(null);
}

function w3_open() {
    document.getElementById("mySidenav").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
}
function initMap() {
	// Create a map object and specify the DOM element for display.
	var museo = {lat: -29.908925, lng: -71.246824};

	var map1 = new google.maps.Map(document.getElementById('map1'), {
	  center: museo,
	  zoom: 16
	});
	var marker1 = new google.maps.Marker({
		position: museo,
		map: map1,
		title: 'Museo Mineralogico Ignacio Domeyko'
	});
	var map2 = new google.maps.Map(document.getElementById('map2'), {
	  center: museo,
	  zoom: 16
	});
	var marker2 = new google.maps.Marker({
		position: museo,
		map: map2,
		title: 'Museo Mineralogico Ignacio Domeyko'
	});

}
