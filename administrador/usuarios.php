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

	<body>
		<div class="frame w3-container">
			<div class="titulo-form w3-row">
				<div class="w3-col l12">
					<div id="editUsuario">
						<h2>Datos Personales</h2>
						<div id="datosUsuario">
							<!--<div id = "alertas" style="display:none" >
								<div id ="alerRut" class="w3-panel w3-red">
								    <span onclick="this.parentElement.style.display='none'" class="w3-closebtn">&times;</span>
								    <h3>Danger!</h3>
								    <p>El rut es invalido, ingreselo nuevamente.</p>
								</div>
							</div>-->

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