<?php

session_start();
if (isset($_SESSION['p_usuarios'])) {

  if($_SESSION['p_usuarios'] == 0)
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
					<span >Lista de Usuarios</span>
				</div>
			</div>
			<br>
            <table class='w3-table-all w3-hoverable'  id="tablaLista">
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
			</table>
            <br>
		</div>
	</body>
</html>