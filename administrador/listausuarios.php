<?php
/*
session_start();
if (!isset($_SESSION['user'])) {
  //readfile('login.html');
  header('location:login.html');
  exit();
}
echo "<p>".$_SESSION['user']."</p>";
echo "<p>".$_SESSION['nombre']."</p>";
echo "<p>".$_SESSION['apellido']."</p>";
*/
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