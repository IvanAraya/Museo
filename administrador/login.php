<?php 
  session_start();
  if (isset($_SESSION['rut'])) {
    header('location:index.php');
    exit();
  }

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
                    <h3>Plataforma administartiva99999999999999999999999</h3>
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