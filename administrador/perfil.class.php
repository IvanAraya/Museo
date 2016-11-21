<<?php
	class perfil
	{
		function obtenerDato()
		{
			$nombre = $_SESSION['nombre'];
			$nombre = "daniel";
			var $respuesta= array('nombre' => $nombre);
			return $respuesta;
		}
		
	}

 ?>