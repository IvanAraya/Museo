<?php 

//--------------------------------------------------------------------------
//aqui se elimina la sesion si se vuelve a entrar al loggin, es solo hasta agregar el boton logout de la Spagina principal

	session_start();
	if (!isset($_SESSION['nombre'])) {
	  session_destroy();
	}
	

//---------------Redireccionar si ya se inicio la sesion--------------------
	/*
  session_start();
  if (isset($_SESSION['nombre'])) {
    //readfile('login.html');
    header('location:index.php');
    exit();
  }*/

?>



 <!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <div class="main">
            <div id="panel_izquierdo" class="enLinea">
                <img src="img/logoadmin.png" class="enLinea" width="150px">
                <div id=texto_izquierda class="enLinea aDerecha">
                    <h2 style="font-size: 30px">Museo Mineralogico</h2>
                    <h3>Plataforma administartiva</h3>
                </div>

            </div>
            <form id="login" action="autentificar.php" method="post" class="enLinea" >
                <input type="text" name="rut" placeholder="Rut" >
                <br><br>
                <input type="password" name="pass" placeholder="Contraseña"> 
                <br><br>
                <input type="submit" name="b_ingresar" value="Ingresar" >
            </form>
        </div>
    </body>
</html>