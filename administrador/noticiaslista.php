<?php

session_start();
if (isset($_SESSION['p_actividad'])) {

  if($_SESSION['p_actividad'] == 0)
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
	<body >
		<div class="frame w3-container">
			
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span >Actividad Reciente</span>
				</div>
			</div>
			<br>

			<table class="w3-table-all w3-hoverable" id="tablaLista">
				<tr>
					<th width="500px">Titulo</th>
                    <th>Fecha</th>
					<th>Estado</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</table>
			<br>
		</div>
	</body>
</html>