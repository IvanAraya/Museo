var myIndex = 0;
var slideIndex = 1;

function home_onload(){
	
	carousel();
	showDivs(slideIndex);
	cargarNoticias();
	
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

	var obj = new RemoteObject('home');
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
			
			imagen.src = 'administrador/' + noticias[i].imagen ;
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