<?php

session_start();
if (isset($_SESSION['p_recursos'])) {

  if($_SESSION['p_recursos'] == 0)
  {
    die("acceso denegado");
    exit();
  }
}
else{
  die("acceso denegado");
}
?>

<html>
	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span> Listado de Recursos </span>
				</div>
			</div> <br>
			
			<div class="w3-responsive">
				<table class="w3-table-all w3-hoverable" id="tablaLista">
					<tr>
						<th> Titulo </th>
						<th> Nombre archivo </th>
						<th> Fecha </th>
						<th> &nbsp; </th>
						<th> &nbsp; </th>
					</tr>
				</table> <br>
			</div>
		</div>
	</body>
</html>