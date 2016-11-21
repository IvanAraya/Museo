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
			<form id="busqueda">
				<div>
					<div class="w3-row">
						<div class="w3-threequarter w3-container"><input type="search" id="q" name="q" style="width:100%"/></div>
						<div class="w3-quarter w3-container"><input type="button" value="Buscar" style="width:100%" class="w3-btn w3-light-gray w3-border w3-round-xlarge" /></div>
					</div>
				</div>
				<div class="w3-accordion" style='margin-top:16px;'>
					<div id="divAvanzada" class="w3-accordion-content">
						<div class="w3-row" >
							<div class="w3-col m6">
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Num. Muestra</div>
									<div class="w3-col l6"><input type="text" style="width:100%;" /></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Vitrina</div>
									<div class="w3-col l6"><select id="cmbVitrinas" style="width:100%;" ></select></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Colecci&oacute;n</div>
									<div class="w3-col l6"><select id="cmbColecciones" style="width:100%;" ></select></div>
								</div>
							</div>
							<div class="w3-col m6">
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Pais / Continente</div>
									<div class="w3-col l6"><select id="cmbPais" style="width:100%;" onchange="llenarRegion()" ></select></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Regi&oacute;n</div>
									<div class="w3-col l6"><select id="cmbRegion" style="width:100%;" onchange="llenarUbicacion()"></select></div>
								</div>
								<div class="w3-row" style="margin:5px;">
									<div class="w3-col l6 w3-container" style="text-align:right;">Ubicaci&oacute;n</div>
									<div class="w3-col l6"><select id="cmbUbicacion" style="width:100%;" ></select></div>
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
			  <ul class="w3-pagination w3-small">
				  <li><a href="#">&laquo;</a></li>
				  <li><a class="w3-green" href="#">1</a></li>
				  <li><a href="#">2</a></li>
				  <li><a href="#">3</a></li>
				  <li><a href="#">4</a></li>
				  <li><a href="#">5</a></li>
				  <li><a href="#">&raquo;</a></li>
				</ul>
			</div>
			<div id="divResultados">

			</div>
			<br>
		</div>
	</body>
</html>