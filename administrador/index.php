<?php 

    session_start();
      if (!isset($_SESSION['rut'])) {
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
	 <meta http-equiv="Expires" content="0">
	 <meta http-equiv="Last-Modified" content="0">
	 <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	 <meta http-equiv="Pragma" content="no-cache">
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
      <!--div id="header" class="w3-row">
        <div class="w3-col" style="width:150px;"><img title="logo" alt="logo" src="img/logoadmin.png" style="margin-left:10px;"></div>
        <div class="w3-rest" >
          <div class="w3-hide-small"><br><img title="logo" alt="logo" src="img/textoadmin.png"><br><br></div>
          <div class="menu-horizontal">
            <ul class="w3-navbar" id="menu-principal">
            </ul>
          </div>
        </div>
      </div-->
		
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
			<div class="w3-row menu-horizontal" >
				<ul class="w3-navbar" id="menu-principal">
            </ul>
			</div>			
      </div>
		
		
      <div id="cuerpo" class="w3-row" >
			<div class="w3-panel w3-center">
				<img src="img/cargando.gif" /><br>
				<span>Cargando...</span>
			</div>
		</div>
		
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
			</div>
   </div>
  </body>
</html>
