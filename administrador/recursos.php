<?php

?>

<html>

	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span> Editar Recurso </span>
				</div>
			</div> <br>
		
		<form id="formulario_recursos"> 
			<div class="w3-row w3-panel">
				<div class="w3-col w3-center m6 w3-container">
					<label for="titulo"> Titulo </label>
				</div>
				<div class="w3-col w3-center m6 w3-container">
					<input name="titulo">
				</div>
			</div>
			<div class="w3-row w3-panel">
				<div class="w3-col w3-center m6 w3-container">
					<label for="descripcion"> Descripci&oacute;n </label>
				</div>
				<div class="w3-col w3-center m6 w3-container">
					<input name="descripcion">
				</div>
			</div>
			<div class="w3-row w3-panel">
				<div class="w3-col w3-center m6 w3-container">
					<input class="control center w3-btn w3-light-gray w3-border w3-round-xlarge" value="Examinar" type="button" onclick="">
				</div>
				<div class="w3-col w3-center m6 w3-container">
					<input name="archivo" readonly=�readonly�>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col w3-center">
					<input class="control center w3-btn w3-light-gray w3-border w3-round-xlarge" value="Guardar"  type="button" onclick="">
					<input class="control center w3-btn w3-light-gray w3-border w3-round-xlarge" value="Cancelar" type="button" onclick="cancelarRecurso()">
					<input class="control center w3-btn w3-red        w3-border w3-round-xlarge" value="Eliminar" type="button" onclick="">
				</div>
			</div>
			<br>
		</form>
		
	</body>
	
</html>