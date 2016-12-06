<?php 

//--------------------------------------------------------------------------
//aqui se elimina la sesion si se vuelve a entrar al loggin, es solo hasta agregar el boton logout de la Spagina principal

	session_start();
	if (!isset($_SESSION['nombre'])) {
	  session_destroy();
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
            <div id="panel_izquierdo" class="enLinea"><br>
                <img src="img/logoadmin.png" class="enLinea" width="150px">
                <div id=texto_izquierda class="enLinea aDerecha">
                    <h2 style="font-size: 30px">Museo Mineralogico</h2>
                    <h3>Plataforma administartiva</h3>
                </div>

            </div>
            <form id="login" action="autentificar.php" method="post" class="enLinea" >
                <input type="text" name="rut" placeholder="Rut" >
                <br><br>
                <input type="password" name="pass" placeholder="Contrase&ntilde;a"> 
                <br>

                <div id="divCaptcha">
                    <p style="text-align: center;">
                        <img src="captcha.php" width="120px" height="30px"  border="1" alt="CAPTCHA" id="captcha_img">
                        
                            <a href="#" onclick="
                              document.getElementById('captcha_img').src = 'captcha.php?' + Math.random();
                              document.getElementById('captcha').value = '';
                              return false;
                            ">recargar</a>
                    </p>
                    <input type="text" name="captcha" id="captcha" placeholder="Captcha"><br><br>
                </div>
                <input type="submit" name="b_ingresar" value="Ingresar" >
            </form>
        </div>
    </body>
</html>