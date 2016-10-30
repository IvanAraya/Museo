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
	 <script src="admin.js"></script>
    <title></title>
  </head>
  <body onload="main()">
    <div class="fondo">
    <div id="pagina">
      <div id="header" class="w3-row">
        <div class="w3-col s2 m2 l2"><img title="logo" alt="logo" src="img/logoadmin.png"></div>
        <div class="w3-rest">
          <div class="w3-container"><img title="logo" alt="logo" src="img/textoadmin.png"></div>
          <div class="w3-container" id="menu-horizontal">
            <ul class="w3-navbar" id="menu-principal">
              <li class="w3-opennav w3-right w3-hide-large"> menu</li>
            </ul>
          </div>
        </div>
      </div>
      <div id="cuerpo" class="w3-row"> esto es el cuerpo </div>
    </div>
    </div>
  </body>
</html>
