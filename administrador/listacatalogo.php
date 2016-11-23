<!DOCTYPE html>
<html>
	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span >B&uacute;squeda de muestra</span>
				</div>
			</div>
			<br>
			<form id="busqueda" action="javascript:buscar(1)">
				<div>
					<div class="w3-row">
						<div class="w3-half w3-container"><input type="search" id="q" name="q" style="width:100%" /></div>
						<div class="w3-quarter w3-container"><input type="submit" value="Buscar" style="width:100%" class="w3-btn w3-light-gray w3-border w3-round-xlarge" /></div>
						<div class="w3-quarter w3-container"><input type="reset" value="Limpiar" style="width:100%" class="w3-btn w3-light-gray w3-border w3-round-xlarge" /></div>
					</div>
				</div>
				<div class="w3-accordion" style='margin-top:16px;'>
					<div id="divAvanzada" class="w3-accordion-content">
						<div class="w3-row" >
							<div class="w3-col m6">
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Num. Muestra</div>
									<div class="w3-col l6"><input type="text" style="width:100%;" id="txtNumMuestra" name="txtNumMuestra"/></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Vitrina</div>
									<div class="w3-col l6"><select id="cmbVitrinas" name="cmbVitrinas" style="width:100%;" ></select></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Colecci&oacute;n</div>
									<div class="w3-col l6"><select id="cmbColecciones" name="cmbColecciones" style="width:100%;" ></select></div>
								</div>
							</div>
							<div class="w3-col m6">
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Pais / Continente</div>
									<div class="w3-col l6"><select id="cmbPais" name="cmbPais" style="width:100%;" onchange="llenarRegion()" ></select></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Regi&oacute;n</div>
									<div class="w3-col l6"><select id="cmbRegion" name="cmbRegion" style="width:100%;" onchange="llenarUbicacion()"></select></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Ubicaci&oacute;n</div>
									<div class="w3-col l6"><select id="cmbUbicacion" name="cmbUbicacion" style="width:100%;" ></select></div>
								</div>
							</div>
						</div>						
					</div>
					<div><i id="divAvanzada-btn" onclick="acordion('divAvanzada')" class="material-icons w3-right w3-small w3-btn w3-light-gray w3-border w3-round-xlarge">expand_more</i></div>
				</div>
			</form>
			
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span >Resultados</span>
				</div>
			</div>
			<br>
			<div id="divNumResultados" class="w3-small" ></div>
			<div id="divPaginas">
				<ul class="w3-pagination w3-small w3-center" id="paginador">
				</ul>
			</div>
			<div id="divResultados">

			</div>
			<br>
		</div>
		<div id="modalWindow" class="w3-modal" >				
			<div id="modalContent" class="w3-modal-content w3-card-24 w3-center w3-animate-zoom" style="padding:5px;">
				<span class="w3-closebtn w3-container w3-padding-16 w3-display-topright" style="color:white;" onclick="cerrarModal()">&times;</span>
				<div style="background-color:#999; margin:0px;">
					<img id="modalImage" class="w3-image w3-card-2" style="max-height:350px;" src="">
				</div>
				<div class="w3-container">
					<div class="w3-row">
						<div class="w3-half">
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">N. Muestra:</div>
								<div class="w3-col m7" id="lblnMuestra" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Descripci&oacute;n : </div>
								<div class="w3-col m7" id="lblDescripcion" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">F&oacute;rmula Qu&iacute;mica : </div>
								<div class="w3-col m7" id="lblFormula" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Tipo Muestra : </div>
								<div class="w3-col m7" id="lblTipo" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Carac. Tipo Muestra : </div>
								<div class="w3-col m7" id="lblCaracteristica" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Vitrina : </div>
								<div class="w3-col m7" id="lblVitrina" style="text-align:left;">--</div>
							</div>
						</div>
						<div class="w3-half">
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Pa&iacute;s / Continente : </div>
								<div class="w3-col m7" id="lblPais" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Regi&oacute;n : </div>
								<div class="w3-col m7" id="lblRegion" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Ubicaci&oacute;n : </div>
								<div class="w3-col m7" id="lblUbicacion" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Colecci&oacute;n : </div>
								<div class="w3-col m7" id="lblColeccion" style="text-align:left;">--</div>
							</div>
							<div class="w3-row">
								<div class="w3-col m5" style="text-align:left;">Adquisici&oacute;n : </div>
								<div class="w3-col m7" id="lblAdquisicion" style="text-align:left;">--</div>
							</div>
							
						</div>
					</div>
					<div>
						<input type="hidden" id="idMuestra"/>
						<input type="button" id="btnEditar" value="Editar" onclick="cargarEditor()" class="w3-btn w3-light-gray w3-border w3-round-xlarge">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>