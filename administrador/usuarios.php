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
								//echo "<tr>\n":
								//	echo "<th>Rut</th>";
								//	echo "<th>Nombre</th>";
								//	echo "<th>Mail</th>";
								//echo "</tr>\n";
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
							$conn = null;
						 ?>
						
					</div>

					<div id="editUsuario">
						<h1>Editar Usuario</h1>
						<h2>Datos Personales</h2>
						<div id="datosUsuario">
							<table>
								<tr>
									<td>Rut</td>
									<td>
										<input id="Erut" type="text" placeholder="eje: 11111111-1">
									</td>
								</tr>
								<tr>
									<td>Nombre</td>
									<td>
										<input id="Enombre" type="text">
									</td>
								</tr>
								<tr>
									<td>Apellido</td>
									<td>
										<input id="Eapellido" type="text">
									</td>
								</tr>
								<tr>
									<td>Mail</td>
									<td>
										<input id="Email" type="text" placeholder='mi@ejemplo.com'>
									</td>
								</tr>
								<tr>
									<td>Contraseña</td>
									<td>
										<input id="Epass" type="text">
									</td>
								</tr>
							</table>
						</div>

						<div id="permisoUsuario">
							<h2>Permiso de usuario</h2>

							<fieldset>
									<input id ="AS" type="checkbox">Administrador de sistema <br>
									<input id ="EC" type="checkbox">Editar Catálogo <br>
									<input id ="EAR" type="checkbox">Editar Actividad Reciente <br>
									<input id ="ER" type="checkbox">Editar Recursos <br>
							</fieldset>	
						</div>
						
						<table>
							<tr>
								<td><button onclick="validando()">Guardar</button></td>
								<td><button>Cancelar</button></td>
								<td><button>Eliminar</button></td>
							</tr>
						</table>

					</div>

				</div>
			</div>
			<br>
		</div>
	</body>
</html>