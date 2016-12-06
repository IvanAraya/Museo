var obj = new RemoteObject('home');
var myIndex = 0;
var slideIndex = 1;

function home_onload(){
	
	cargarBanner();
	
	cargarNoticias();
	
}
//--------------------------------------------------------------------------------------------------------
function cargarBanner(){
	
	obj.callMethod('cargarBanner',null,function(banner){
		var divBanner = document.getElementById('divBanner');		
		var divBotonesBanner = document.getElementById('divBotonesBanner');
		
		for(i=0 ; i< banner.length; i++){
			var img = document.createElement('img');
			img.className = 'mySlides w3-animate-fading' ;
			img.style.width ='100%'; 
			img.style.height = '300px';			
			img.src = banner[i] ;
			divBanner.appendChild(img);			
			var btn = document.createElement('span');
			btn.index = i;
			btn.className = 'w3-badge demo w3-border w3-transparent w3-hover-white' ;			
			btn.onclick = function(){currentDiv(this.index);}
			btn,innerHTML = '&nbsp;'
			divBotonesBanner.appendChild(btn);			
		}
		carousel();
	});
}
//--------------------------------------------------------------------------------------------------------
function carousel() {
	try{
		var i;
		var x = document.getElementsByClassName("mySlides");
		if(!x)
			return false;
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";  
		}
		myIndex++;
		if (myIndex > x.length) {myIndex = 1}    
			x[myIndex-1].style.display = "block";  
		setTimeout(carousel, 6000); 
	}catch(err){
		return false;
	}
	    
}
//--------------------------------------------------------------------------------------------------------
function plusDivs(n) {
  showDivs(slideIndex += n);
}
//--------------------------------------------------------------------------------------------------------
function currentDiv(n) {
  showDivs(slideIndex = n);
}
//--------------------------------------------------------------------------------------------------------
function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
//--------------------------------------------------------------------------------------------------------
function cargarNoticias(){

	
	obj.callMethod('cargarNoticias',null,function(noticias){
		var divNoticias = document.getElementById('divNoticias');
		for(i=0;i<noticias.length;i++){
			var bloque = document.createElement('div');
			var noticia = document.createElement('p');
			var titulo = document.createElement('h3');
			var fecha = document.createElement('span');
			var iconofecha = document.createElement('i');
			var imagen = document.createElement('img');
			
			
			titulo.innerHTML = noticias[i].titulo;
			iconofecha.className = 'material-icons';
			iconofecha.innerHTML = 'event' ;
			fecha.appendChild(iconofecha);
			fecha.appendChild(document.createTextNode(' '+noticias[i].fecha));	
			
			imagen.src = noticias[i].imagen ;
			imagen.style.maxWidth = '300px';
			imagen.className = 'img-noticia';			
			
			noticia.className = 'noticia';
			noticia.appendChild(imagen);
			noticia.appendChild(titulo);
			//noticia.appendChild(document.createElement('br'));
			noticia.appendChild(fecha);
			noticia.appendChild(document.createElement('br'));
			noticia.appendChild(document.createElement('br'));
			noticia.appendChild(document.createTextNode(noticias[i].cuerpo));

			bloque.appendChild(noticia);
			bloque.className = 'w3-row w3-content';
			divNoticias.appendChild(bloque);
			
		}
		
	});
}