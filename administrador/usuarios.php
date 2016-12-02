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

	<body>
		<div class="frame w3-container">
            <div class="titulo-form w3-row">
                <div class="w3-col l12">
                    <span >Datos Personales</span>
                </div>
            </div>
            <br>

					<div id="editUsuario">
						<div id="datosUsuario">
							<!--<div id = "alertas" style="display:none" >
								<div id ="alerRut" class="w3-panel w3-red">
								    <span onclick="this.parentElement.style.display='none'" class="w3-closebtn">&times;</span>
								    <h3>Danger!</h3>
								    <p>El rut es invalido, ingreselo nuevamente.</p>
								</div>
							</div>-->

							<div class="w3-row" style="margin:5px;">
                                <div class="w3-col m6 w3-container">Rut<br></div>
                                <div class="w3-col m6 w3-container">
                                    <input id="Erut" type="text" onblur="validar_rut(this)" placeholder="ej: 11111111-1"><br>
                                </div>
                            </div>
							<div class="w3-row" style="margin:5px;">
								<div class="w3-col m6 w3-container">Nombre</div>
								<div class="w3-col m6 w3-container">
									<input id="Enombre" type="text"  length=10>
								</div>
							</div>
							<div class="w3-row" style="margin:5px;">
								<div class="w3-col m6 w3-container">Apellido</div>
								<div class="w3-col m6 w3-container">
									<input id="Eapellido" type="text">
								</div>
							</div>
							<div class="w3-row" style="margin:5px;">
								<div class="w3-col m6 w3-container">Mail</div>
								<div class="w3-col m6 w3-container">
									<input id="Email" type="text" placeholder='mi@ejemplo.com'>
								</div>
							</div>
							<!--
							<div class="w3-row" style="margin:5px;">
								<div class="w3-col m6 w3-container">Contrase&ntilde;a</div>
								<div class="w3-col m6 w3-container">
									<input id="Epass" type="text">
								</div>
							</div>
							-->
						</div>

						<div id="permisoUsuario">
							<p class="titulo-form">Permiso de usuario</p>

							<fieldset>
									<input id ="AS" type="checkbox"> Administrador de sistema <br>
									<input id ="EC" type="checkbox"> Editar Catálogo <br>
									<input id ="EAR" type="checkbox"> Editar Actividad Reciente <br>
									<input id ="ER" type="checkbox"> Editar Recursos <br>
							</fieldset>	
						</div>
						<br>
						<div class="centrar">
							<button id = "guardar" class="w3-btn w3-light-gray w3-border w3-round-xlarge" onclick="validando()" >Guardar</button>
							<button id = "cancelar" class="w3-btn w3-light-gray w3-border w3-round-xlarge" onclick="cancelar()">Cancelar</button>
							<button id = "eliminar" class="w3-btn w3-red w3-border w3-round-xlarge" onclick="eliminarUsuario()" >Eliminar</button>
						</div>
						<br>
					</div>

				</div>
			</div>
			<br>
		</div>
	</body>
</html>