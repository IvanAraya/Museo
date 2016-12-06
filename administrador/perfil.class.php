<?php

	include('../../configuracion.php');
	include('../../data.php');

	class perfil
	{
		
		var $db;
	//--------------------------------------------------------------------------------------------------------
		function __construct(){
			
			$configuracion = new Configuracion();
			$baseDato = new BaseDatos($configuracion);
			$this->db = $baseDato->conectarPDO();
		}
	//--------------------------------------------------------------------------------------------------------
		function obtenerDato()
		{
			$rut = $_SESSION['rut'];

			$stmt = $this->db->prepare("SELECT * FROM usuarios_administracion WHERE rut = :rut");
			$stmt->bindParam(":rut", $rut);
			$stmt->execute();

			if($row = $stmt->fetch())
			{
				$respuesta = array(

					'rutFormato' => number_format($rut,0,',','.'),
					'rut' => $rut,
					'dv' => $row['dv'],
					'nombre' => $row['nombre'],
					'apellido' => $row['apellido'],
					'mail' => $row['mail']

				);

			}
			$this->db = null;

			return $respuesta ;
		}

		function guardarDatos()
		{
			$datos = $_POST['datos'] ;
			$datos = json_decode($datos);
			$rut = $datos[0];
			$pass = $datos[1];
			$email = $datos[2];

			if (strlen($pass)>0)
			{
				$stmt = $this->db->prepare("UPDATE usuarios_administracion SET mail=:mail, password=:password WHERE rut=:rut");

				$stmt->bindParam(":rut", $rut);
				$stmt->bindParam(":mail", $email);
				$stmt->bindParam(":password", md5($pass));
			}
			else
			{
				$stmt = $this->db->prepare("UPDATE usuarios_administracion SET mail=:mail WHERE rut=:rut");

				$stmt->bindParam(":rut", $rut);
				$stmt->bindParam(":mail", $email);
			}
			

			$stmt->execute();
			$this->db = null;
			return true;
		}
		
	}

 ?>