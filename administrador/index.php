<?php 
	//TODO
	//Gestionar permisos de ususrio al formulario;
	$permiso = true;
	if(!$permiso)
		die('Acceso denegado');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/w3.css">
	 <script src="base/ajax.js"></script>
	 <script src="index.js"></script>
    <title></title>
  </head>
  <body onload="init()">
    <div id="pagina">
      <div id="header" class="w3-row">
        <div class="w3-col s2"><img title="logo" alt="logo" src="img/logoadmin.png" style="margin-left:10px;"></div>
        <div class="w3-rest" >
          <div class="w3-hide-small"><br><img title="logo" alt="logo" src="img/textoadmin.png"><br><br></div>
          <div class="menu-horizontal">
            <ul class="w3-navbar" id="menu-principal">
              <!--li class="w3-opennav w3-right w3-hide-large">Men&uacute;</li-->
            </ul>
          </div>
        </div>
      </div>
      <div id="cuerpo" class="w3-row"> Cargando... </div>
    </div>
  </body>
</html>
