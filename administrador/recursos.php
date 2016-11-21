<?php

?>

<html>
	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span id="titulo_formulario"> Editar Recurso </span>
				</div>
			</div> <br>
		<form id="formulario_recursos"> 
			<div class="w3-row w3-panel">
				<div class="w3-col w3-center m6 w3-container">
					<label for="titulo"> Titulo </label>
				</div>
				<div class="w3-col w3-center m6 w3-container">
					<input id="campo_titulo" name="titulo" style="width:100%" maxlength="50">
				</div>
			</div>
			<div class="w3-row w3-panel">
				<div class="w3-col w3-center m6 w3-container">
					<label for="descripcion"> Descripci&oacute;n </label>
				</div>
				<div class="w3-col w3-center m6 w3-container">
					<textarea id="campo_descripcion" name="descripcion" style="width:100%;height:200px;" maxlength="250"></textarea>
				</div>
			</div>
			<div class="w3-row w3-panel">
				<div class="w3-col w3-center m6 w3-container">
					<input id="boton_examinar" class="control center w3-btn w3-light-gray w3-border w3-round-xlarge" 
					value="Examinar" type="button" onclick=document.getElementById("cargar").click();>
					<input id="cargar" name="archivo" type="file" accept="media_type" readonly=”readonly”
					style="display:none" onchange="mostrarNombre()">
				</div>
				<div class="w3-col w3-center m6 w3-container">
					<input id="campo_archivo" name="archivo" readonly=”readonly” style="width:100%">
				</div>
			</div>
			<div class="w3-row w3-panel">
				<div class="w3-col w3-center">
					<input id="boton_agregar"  class="control center w3-btn w3-light-gray w3-border w3-round-xlarge" 
					value="Guardar"  type="button" onclick="escribirBD()">
					<input id="boton_cancelar" class="control center w3-btn w3-light-gray w3-border w3-round-xlarge" 
					value="Cancelar" type="button" onclick="cancelarRecurso()">
					<input id="boton_eliminar" class="control center w3-btn w3-red        w3-border w3-round-xlarge" 
					value="Eliminar" type="button" onclick="eliminar()">
				</div>
			</div>
		</form>
	</body>
</html>