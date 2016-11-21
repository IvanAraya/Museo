<?php 

    session_start();
      if (!isset($_SESSION['nombre'])) {
        //readfile('login.html');
        header('location:login.php');
        exit();
      }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	 <script src="base/ajax.js"></script>
	 <script src="index.js"></script>
	 <script src="js/nicEdit/nicEdit.js" type="text/javascript"></script>
    <title></title>
  </head>
  <body onload="init()">
    <div id="pagina">
      <div id="header" class="w3-row">
        <div class="w3-col" style="width:150px;"><img title="logo" alt="logo" src="img/logoadmin.png" style="margin-left:10px;"></div>
        <div class="w3-rest" >
          <div class="w3-hide-small"><br><img title="logo" alt="logo" src="img/textoadmin.png"><br><br></div>
          <div class="menu-horizontal">
            <ul class="w3-navbar" id="menu-principal">
              <!--li class="w3-opennav w3-right w3-hide-large">Men&uacute;</li-->
              <!--li>
                <a href="cerrar.php">Cerrar Sesi&oacute;n</a>
              </li-->
            </ul>
          </div>
        </div>
      </div>
      <div id="cuerpo" class="w3-row">
			<div class="w3-panel w3-center">
				<img src="img/cargando.gif" /><br>
				<span>Cargando...</span>
			</div>
		</div>
    </div>
  </body>
</html>
