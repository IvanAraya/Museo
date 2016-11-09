<!DOCTYPE html>
<html>
	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span >Actividad Reciente</span>
				</div>
			</div>
			<br>
			<form id="form">
			<div class="w3-row">
				<div class="w3-container m4 w3-col">
					<img src="img/subir.jpg" width="200px" height="250px" id="imagenS">
					<input type="button" name="b_subir_imagen" value="Subir imagen" onclick="subirImagen()" class="w3-btn w3-light-gray w3-border w3-round-xlarge">
				</div>
				<div class="w3-container m8 w3-col">
					<label for="ti">Titulo</label>		
					<input type="text" name="titulo" id="titulo" style="width:100%;"><br>
					<label for="fecha">Fecha</label>
					<input type="date" name="fecha" id="fecha">
					<label for="desc">Descripción</label>
					<textarea name="contenido" id="contenido" style="width:100%;"></textarea>
				</div>
			</div>
				<div class="centrar">
					<input type="button" name="b_guardar" value="Guardar" onclick="guardar()" class="w3-btn w3-light-gray w3-border w3-round-xlarge">
					<input type="button" name="b_cancelar" value="Cancelar" onclick="cancelar()" class="w3-btn w3-light-gray w3-border w3-round-xlarge"> 					
					<input type="button" name="b_publicar" value="Publicar" onclick="publicar()" class="w3-btn w3-light-gray w3-border w3-round-xlarge">
					<input type="button" id="b_eliminar" value="Eliminar" onclick="eliminar()" class="w3-btn w3-red w3-border w3-round-xlarge"> 
				</div>
			</form>
		</div>
	</body>
</html>

