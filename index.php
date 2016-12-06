<?php 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta http-equiv="Expires" content="0">
	 <meta http-equiv="Last-Modified" content="0">
	 <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	 <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="css/w3.css">
	 <link rel="stylesheet" href="css/site.css">    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" > 
	 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD65WRMY9cCiizhCq2ku-12c7UsRmuUjOg &callback=initMap"async defer></script>
	 <script src="base/ajax.js"></script>
	 <script src="index.js"></script>
    <title>Museo Mineral&oacute;gico Ignacio Domeyko</title>
  </head>
  <body onload="init()">
		<!-- HEADER ------------------------------------------------------------------->
      <div id="header" >
			<div class="w3-row">
				<div class="w3-col w3-left w3-center"  style="width:130px;height:150px;"><img title="logo ULS" alt="logo ULS" src="img/logoULS.png" style="margin-top:30px;"/></div>
				<div class="w3-col w3-right w3-center" style="width:150px;height:150px;"><img title="logo Museo" alt="logo Museo" src="img/logoMuseo.png" style="margin-top:9px;"/></div>
				<div class="w3-rest w3-center w3-hide-small w3-hide-medium" style="height:150px;">
					<img title="logo" alt="logo" src="img/texto-large.png" style="margin-top:34px;" />
				</div>
				<div class="w3-rest w3-center w3-hide-small w3-hide-large" style="height:150px;">
					<img title="logo" alt="logo" src="img/texto-medium.png" style="margin-top:15px;" />
				</div>
			</div>
			<div class="w3-row barra-horizontal" style="min-height:40px;">
				<div class="w3-hide-medium w3-hide-large centrar">Museo Mineral&oacute;gico Ignacio Domeyko</div>
				<div id="pageName" class="w3-rest w3-large" >Home&nbsp;</div>
			</div>			
      </div>
		<!-- / HEADER ------------------------------------------------------------------->
      <div style="height:10px;" class="w3-hide-medium w3-hide-small"></div>
      <div id="pagina" >
			<div class="w3-row">
				<div class="w3-black w3-col w3-hide-medium w3-hide-small menu" style="width:200px; height:100%" >
				<!-- MENU ------------------------------------------------------------------->
					<div><a class="w3-btn" href="javascript:load('home','Home')">Home</a></div>
					<div><a class="w3-btn" href="javascript:load('listacatalogo','Cat&aacute;logo Virtual')">Cat&aacute;logo Virtual</a></div>
					<div class="w3-dropdown-hover">
						<span class="w3-btn" >Historia <i class="fa fa-caret-down"></i></span>
						<div class="w3-dropdown-content" style="margin-left:20px;width:200px;">
							<a href="javascript:load('domeyko','Historia Ignacio Domeyko')">Ignacio Domeyko</a>
							<a href="javascript:load('eminas', 'Historia Escuela de Minas')">Escuela de Minas</a>
						</div>
					</div>
					<div><a class="w3-btn" href="javascript:load('recursos', 'Recursos Descargables')">Recursos</a></div>
				<!-- /MENU ------------------------------------------------------------------->
					<br>
					<hr style="margin:5px;">
					<div id="w3-container">
						<span class="w3-container">Ubicaci&oacute;n</span>
						<div id="map1" class="mapa"></div>
					</div>
					<br>
					<hr style="margin:5px;">
					<div class="w3-container">
						 <span>Contacto</span><br><br>
						 <p class="w3-small">
						 Direcci&oacute;n:<br>
						 Benavente 980, La Serena.<br>
						 Campus Ignacio Domeyko.<br>                
						 Fono: 
						 051-2204096<br>                  
						 Correo electr&oacute;nico:
						 <a href="mailto:mmineralogico@userena.cl?subject=Consultas">mmineralogico@userena.cl</a>
						 </p>
					</div>
					<br>
				</div>
				<div class="w3-rest">
				<!-- menu moviles ------------------------------------------------------------------->
					<div class="w3-hide-large w3-black" style="text-align:left;">
						<ul class="w3-navbar menu">
							<li><a href="javascript:load('home','Home')">Home</a></li>
							<li><a href="javascript:load('listacatalogo','Cat&aacute;logo Virtual')">Cat&aacute;logo Virtual</a></li>
							<li class="w3-dropdown-hover">
								<a href="#">Historia <i class="fa fa-caret-down"></i></a>
								<div class="w3-dropdown-content">
									<a href="javascript:load('domeyko','Historia Ignacio Domeyko')">Ignacio Domeyko</a>
									<a href="javascript:load('eminas', 'Historia Escuela de Minas')">Escuela de Minas</a>
								</div>
							</li>
							<li><a href="javascript:load('recursos', 'Recursos Descargables')">Recursos</a></li>
						<br>
					</div>
				<!-- /menu moviles ------------------------------------------------------------------->
				<!-- CUERPO ------------------------------------------------------------------->
					<div id="cuerpo" >						
					  	<div class="w3-panel w3-center">
							<img src="img/cargando.gif" /><br>
							<span><h3>Cargando...</h3></span>
						</div>
					</div>
				<!-- /CUERPO ------------------------------------------------------------------->	
					<div class="w3-hide-large w3-black">
						<div id="w3-container">
							<span class="w3-container">Ubicaci&oacute;n</span>
							<div id="map2" class="mapa"></div>
						</div>
						<br>
						<hr style="margin:5px;">
						<div class="w3-container">
							 <span>Contacto</span><br><br>
							 Direcci&oacute;n:<br>
							 Benavente 980, La Serena.<br>
							 Campus Ignacio Domeyko.<br>                
							 Fono: 
							 051-2204096<br>                 
							 Correo electr&oacute;nico:
							 <a href="mailto:mmineralogico@userena.cl?subject=Consultas">mmineralogico@userena.cl</a>
						</div>
						<br>
					</div>
				</div>
			</div>
			<!-- FOOTER ------------------------------------------------------------------->
			<div class="w3-row w3-center footer">
				<div class="w3-third w3-center" style="min-width:300px;">
					<img src="img/footer1.png" alt="footer sections 01" />
				</div>
				<div class="w3-third w3-center w3-hide-medium w3-hide-large" style="min-width:300px;">
					<a href="http://www.userena.cl/index.php/acreditacion"><img src="img/footer3.png" alt="footer sections 03"  /></a>
				</div>
				<div class="w3-third w3-center" style="min-width:300px;">
					<img src="img/footer2.png" alt="footer sections 02"  />
				</div>
				<div class="w3-third w3-center w3-hide-small" style="min-width:300px;">
					<a href="http://www.userena.cl/index.php/acreditacion"><img src="img/footer3.png" alt="footer sections 03"  /></a>
				</div>
			<!-- /FOOTER ------------------------------------------------------------------->
			</div>
		</div>
		
  </body>
</html>
