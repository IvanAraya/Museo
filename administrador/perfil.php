

<?php
//session_start();
//if (!isset($_SESSION['user'])) {
  //readfile('login.html');
  //header('location:login.html');
  //exit();
//}
//echo "<p>".$_SESSION['user']."</p>";
//echo "<p>".$_SESSION['nombre']."</p>";
//echo "<p>".$_SESSION['apellido']."</p>";
//*/
?>
<html>
  <body>
    <div class="frame w3-container">
		<div class="titulo-form w3-row">
			<div class="w3-col l12">
				<span >Perfil</span>
			</div>
		</div>
		<br>
		<form id="formPerfil"> 
			<div class="w3-row">
				<div class="w3-col m6 w3-container">
					<label for="rut">Rut </label>
				</div>
				<div class="w3-col m6  w3-container">
					<span id="rut" >&nbsp;</span> <br>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6  w3-container">
					<label for="nombre" >Nombre </label><br>
				</div>
				<div class="w3-col m6  w3-container">
					<span class="control" id="nombre">&nbsp;</span> 	<br>	
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6  w3-container">
					<label for="password">Contrase&ntilde;a Nueva</label><br>
				</div>
				<div class="w3-col m6  w3-container">
					<input name="password" type="password" id="nuevaPass"> <br>	
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6  w3-container">
					<label for="password">Confirmar Contrase&ntilde;a</label><br>
				</div>
				<div class="w3-col m6  w3-container">
					<input name="password" type="password" id="confPass"> <br>	
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6  w3-container">
					<label for="mail" >Email</label><br>
				</div>
				<div class="w3-col m6  w3-container">
					<input class="control" name="mail" type="email" id="email"> <br>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-rest w3-center">
					<input name="ok" value="ok" type="button" onclick="guardarPass()" class="w3-btn w3-light-gray w3-border w3-round-xlarge">
					<br>
				</div>
			</div>			
		</form>
	</div>
</body></html>