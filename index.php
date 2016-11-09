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
        <div class="w3-rest" >
          <div class="w3-hide-small">
          	<div style="height:30px;"></div>
            <img title="logo" alt="logo" src="img/textobanner.png">
            <div style="height:24px;"></div>
          </div>
          <div class="barra-horizontal">
            <span id="pageName">home &nbsp;</span>
          </div>
        </div>
      </div>
      <div style="height:10px;"></div>
      <div id="pagina">
      
        <!-- Sidenav -->
        <div class="w3-sidenav w3-collapse w3-black" style="width:200px;" id="mySidenav">
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-large w3-hide-large">cerrar &times;</a>
            <a href="javascript:load('home')">Home</a>
            <a href="javascript:load('catalogo')">Cat&aacute;logo Virtual</a>
            <div class="w3-dropdown-hover">
                <a href="#">Historia <i class="fa fa-caret-down"></i></a>
                <div class="w3-dropdown-content">
                  <a href="javascript:load('domeyko')">Ignacio Domeyko</a>
                  <a href="javascript:load('eminas')">Escuela de Minas</a>
                </div>
              </div>
            <a href="#">Recursos</a>
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
        </div>
      
      <span class="w3-opennav w3-xlarge w3-hide-large" style="margin-left:5px;" onclick="w3_open()">&#9776;</span>   
      <div id="cuerpo" class="w3-main" style="margin-left:200px">
		   
        <br>Contenido
        <br>
      </div>
    </div>
  </body>
</html>
