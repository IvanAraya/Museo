<?php

session_start();
if (isset($_SESSION['p_catalogo'])) {

  if($_SESSION['p_catalogo'] == 0)
  {
    die("acceso denegado");
    exit();
  }
}
else{
  die("acceso denegado");
}
?>
<!DOCTYPE html>
<html>
	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span >Muestras</span>
				</div>
			</div>
			<br>
			<div class="w3-center" style="max-width:500px;margin:auto">
				<div class="contenedor-imagen" style="width:100%; border: 1px solid grey;">
					<img id="imgFoto" src="img/subir.jpg">
				</div>
			</div>
			<form id="frmMuestra" >
				<div class="w3-row">
					<div class="w3-rest w3-container w3-center">
						<input type="hidden" id="idMuestra" name="idMuestra" value="">
						<input type="file" id="foto" name="foto" accept="image/*" style="display:none;" onchange="photoPreview(this)">
						<input type="button" value="Subir Imagen" class="w3-btn w3-light-gray w3-border w3-round-large" onclick="document.getElementById('foto').click()">
						<br><br>
					</div>
				</div>
				<div class="w3-row">
					<div class="w3-half">
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">N&deg; Muestra</div>
							<div class="w3-twothird"><input type="text" name="txtNmuestra" id="txtNmuestra" style="width:100%;"/></div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Descripci&oacute;n</div>
							<div class="w3-twothird"><textarea name="txtDescripcion" id="txtDescripcion" style="width:100%;"></textarea></div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">F&oacute;rmula Qu&iacute;mica</div>
							<div class="w3-twothird">
								<div id="panelformula" ></div>
								<textarea name="txtFormula" id="txtFormula" style="width:100%;" ></textarea>
							</div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Tipo Muestra</div>
							<div class="w3-twothird">
								<select name="cmbTipomuestra" id="cmbTipomuestra" style="width:100%;" onchange="llenarCaracteristica()">
									
								</select>
							</div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Caract. Tipo Muestra</div>
							<div class="w3-twothird">
								<select name="cmbCarTipoMuestra" id="cmbCarTipoMuestra" style="width:100%;" >
									
								</select>
							</div>
						</div>
						
					</div>
					<div class="w3-half">
						
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">País/Continente</div>
							<div class="w3-twothird">
								<div class="w3-row">
									<div class="w3-col" style="width:90%;">
										<select name="cmbPais" id="cmbPais" style="width:98%;" onchange="llenarRegion()">
											
										</select>
									</div>
									<div class="w3-col" style="width:10%;"><span class="w3-btn w3-light-gray w3-border w3-round-large w3-small w3-slim" onclick="abrirMantenedor('paises')">...</span></div>
								</div>
							</div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Regi&oacute;n</div>
							<div class="w3-twothird">
								<div class="w3-row">
									<div class="w3-col" style="width:90%;">
										<select name="cmbRegion" id="cmbRegion" style="width:98%;" onchange="llenarUbicacion()">
											
										</select>
									</div>
									<div class="w3-col" style="width:10%;"><span class="w3-btn w3-light-gray w3-border w3-round-large w3-small w3-slim" onclick="abrirMantenedor('regiones','cmbPais')">...</span></div>
								</div>
							</div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Ubicaci&oacute;n</div>
							<div class="w3-twothird">
								<div class="w3-row">
									<div class="w3-col" style="width:90%;">
										<select name="cmbUbicacion" id="cmbUbicacion" style="width:98%;">
											
										</select>
									</div>
									<div class="w3-col" style="width:10%;"><span class="w3-btn w3-light-gray w3-border w3-round-large w3-small w3-slim" onclick="abrirMantenedor('ubicaciones','cmbRegion')">...</span></div>
								</div>
							</div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Colecci&oacute;n</div>
							<div class="w3-twothird">
								<div class="w3-row">
									<div class="w3-col" style="width:90%;">
										<select name="cmbColecciones" id="cmbColecciones" style="width:98%;">
											
										</select>
									</div>
									<div class="w3-col" style="width:10%;"><span class="w3-btn w3-light-gray w3-border w3-round-large w3-small w3-slim" onclick="abrirMantenedor('colecciones')">...</span></div>
								</div>
							</div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Adquisici&oacute;n</div>
							<div class="w3-twothird">
								<div class="w3-row">
									<div class="w3-col" style="width:90%;">
										<select name="cmbAdquisicion" id="cmbAdquisicion" style="width:98%;">
											
										</select>
									</div>
									<div class="w3-col" style="width:10%;"><span class="w3-btn w3-light-gray w3-border w3-round-large w3-small w3-slim" onclick="abrirMantenedor('adquisiciones')">...</span></div>
								</div>
							</div>
						</div>
						<div class="w3-row" style="margin:5px;">
							<div class="w3-third">Vitrina</div>
							<div class="w3-twothird">
								<select name="cmbVitrinas" id="cmbVitrinas" style="width:100%;">
									
								</select>
							</div>
						</div>
					</div>					
				</div>
				<div class="w3-row centrar">
					<br>
					<input type="button" name="b_guardar" value="Guardar" onclick="guardar()" class="w3-btn w3-light-gray w3-border w3-round-xlarge">
					<input type="button" name="b_cancelar" value="Cancelar" onclick="cancelar()" class="w3-btn w3-light-gray w3-border w3-round-xlarge"> 	
					<input type="button" id="b_eliminar" value="Eliminar" onclick="eliminar()" class="w3-btn w3-red w3-border w3-round-xlarge" disabled> 
				</div>
			</form>
			<br>
		</div>
		
		<div id="modalWindow" class="w3-modal" >				
			<div id="modalContent" class="w3-modal-content w3-card-24 w3-center w3-animate-zoom" style="padding:5px;">
				<div  class="w3-panel " ><span id="lblTituloMantenedor"></span></div>
				<span class="w3-closebtn w3-container w3-display-topright" style="color:black;" onclick="cerrarModal()">&times;</span>
				
				<div class="w3-container">
					<input type="text" id="valorRegistro" style="width:60%">
					<input type="hidden" id="idRegistro"/>
					<input type="hidden" id="idAntecesor"/>
					<input type="hidden" id="entidad"/>
					<input type="button" id="btnGuardar" value="Guardar" onclick="guardarRegistroMantenedor()" class="w3-btn w3-light-gray w3-border w3-round-xlarge">					
				</div>
				<br>
				<div class="w3-responsive" style="height:300px">
					<table class="w3-table-all w3-hoverable" id="tablaLista" >
						<tr>
							<th> Nombre</th>
							<th> &nbsp; </th>
							<th> &nbsp; </th>
						</tr>
					</table> <br>
				</div>
				
			</div>
		</div>
		
	</body>
</html>