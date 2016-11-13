<?php 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/site.css">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD65WRMY9cCiizhCq2ku-12c7UsRmuUjOg &callback=initMap"async defer></script>
	 <script src="base/ajax.js"></script>
	 <script src="index.js"></script>
    <title>Museo Mineral&oacute;gico Ignacio Domeyko</title>
  </head>
  <body onload="init()">
    
      <div id="header" class="w3-row">
        <div class="w3-col" style="width:200px;"><img title="logo" alt="logo" src="img/logoadmin.png" style="margin-left:24px;margin-top:5px;"></div>
        <div class="w3-rest w3-hide-small w3-hide-medium" >
          <div>
          	<div style="height:30px;"></div>
            <img title="logo" alt="logo" src="img/textobanner.png" >
            <div style="height:24px;"></div>
          </div>
          <div class="barra-horizontal">
				<div id="pageName" class="w3-large" style="text-align:right;">Home&nbsp;</div>
          </div>
        </div>
      </div>
      <div style="height:10px;"></div>
      <div id="pagina" >
			<div class="w3-row">
			  <!-- Sidenav -->
			  <div class="w3-black w3-col w3-hide-medium w3-hide-small" style="width:200px;" id="mySidenav">
			  <!--div class="w3-sidenav w3-collapse w3-black w3-col" style="width:200px;" id="mySidenav"-->
					<!--a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-large w3-hide-large">cerrar &times;</a-->
					<div><a class="w3-btn" href="javascript:load('home','Home')">Home</a></div>
					<div><a class="w3-btn" href="javascript:load('catalogo','Cat&aacute;logo Virtual')">Cat&aacute;logo Virtual</a></div>
					<div class="w3-dropdown-hover">
						 <span class="w3-btn" >Historia <i class="fa fa-caret-down"></i></span>
						 <div class="w3-dropdown-content" style="margin-left:20px;width:200px;">
							<a href="javascript:load('domeyko','Historia Ignacio Domeyko')">Ignacio Domeyko</a>
							<a href="javascript:load('eminas', 'Historia Escuela de Minas')">Escuela de Minas</a>
						 </div>
					  </div>
					<div><a class="w3-btn" href="javascript:load('recursos', 'Recursos Descargables')">Recursos</a></div>
					<br>
					<hr style="margin:5px;">
					<div id="w3-container">
						<span class="w3-container">Ubicaci&oacute;n</span>
						<div id="map" class="mapa"></div>
					</div>
					<br>
					<hr style="margin:5px;">
					<div class="w3-container">
						 <span>Contacto</span><br><br>
						 <span class="w3-small">
						 Direcci&oacute;n:<br>
						 Benavente 980, La Serena.<br>
						 Campus Ignacio Domeyko.<br>                
						 Fono: 
						 051-2204096<br>                
						 Fax : 
						 051-2223350<br>                
						 Correo electr&oacute;nico:
						 mmineralogico@userena.cl
						 </span>
					</div>
					<br>
			  </div>
				<div class="w3-rest">
					<div class="w3-hide-large w3-black" style="text-align:left;">
						<ul class="w3-navbar">
							<li><a href="javascript:load('home','Home')">Home</a></li>
							<li><a href="javascript:load('catalogo','Cat&aacute;logo Virtual')">Cat&aacute;logo Virtual</a></li>
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
				<!-- CUERPO ------------------------------------------------------------------->
					<div id="cuerpo" class="w3-white">
						
					  <br>Cargando...
					  <br>
					</div>
				<!-- /CUERPO ------------------------------------------------------------------->	
					<div class="w3-hide-large w3-black">
						<div id="w3-container">
							<span class="w3-container">Ubicaci&oacute;n</span>
							<div id="map" class="mapa"></div>
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
							 Fax : 
							 051-2223350<br>                
							 Correo electr&oacute;nico:
							 mmineralogico@userena.cl
						</div>
						<br>
					</div>
				</div>
				</div>
				<div class="w3-row footer">
					<div class="w3-third">
						<img src="img/footer1.png" alt="footer sections 01" />
					</div>
					<div class="w3-third">
						<img src="img/footer2.png" alt="footer sections 02"  />
					</div>
					<div class="w3-third">
						<a href="http://www.userena.cl/index.php/acreditacion"><img src="img/footer3.png" alt="footer sections 03"  /></a>
					</div>
				</div>
			</div>
		
  </body>
</html>
