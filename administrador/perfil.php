<?php

?>
<html>
  <body onload="main()">
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
					<span id="rut" >{Rut}</span> <br>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6  w3-container">
					<label for="nombre" >Nombre </label><br>
				</div>
				<div class="w3-col m6  w3-container">
					<span class="control" id="nombre">{Nombre}</span> 	<br>	
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6  w3-container">
					<label for="password">Contrase&ntilde;a</label><br>
				</div>
				<div class="w3-col m6  w3-container">
					<input name="password" type="password"> <br>	
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6  w3-container">
					<label for="mail" >Email</label><br>
				</div>
				<div class="w3-col m6  w3-container">
					<input class="control" name="mail" type="email"> <br>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-rest w3-center">
					<input class="control center" name="ok" value="ok" type="button" onclick="">
				</div>
			</div>
		</form>
	</div>
</body></html>