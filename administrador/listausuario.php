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
<header>
	<script type="text/javascript" src="validacion.js"></script>
	<script type="text/javascript" src="base/ajax.js"></script>
	<script type="text/javascript" src="usuarios.js"></script>
</header>
	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<span >Usuarios</span>

					<div id="listUsuarios">
						<h1>Listado de Usuarios</h1>
						<?php 
							include("../data.php");
							echo "<table>\n";
								foreach($conn->query('SELECT * FROM usuarios_administracion') as $row)
								{
									echo "<tr id='".$row["rut"]."'>\n";
										echo "<td>".$row["rut"]."</td>\n";
										echo "<td>".$row["nombre"]." ".$row["apellido"]."</td>\n";
										echo "<td>".$row["mail"]."</td>\n";
										echo "<td><button onclick=editarUsuario('".$row["rut"]."')>Edit</button></td>";
										echo "<td><button onclick=eliminarUsuario('".$row["rut"]."')>Eliminar</button></td>";
									echo "</tr>\n";
								}
							echo "</table>\n";
							//$conn = null;
						 ?>
						
					</div>

					
			<br>
		</div>
	</body>
</html>