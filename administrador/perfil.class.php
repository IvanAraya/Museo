<?php
	class perfil
	{
		
		var $db;
	//--------------------------------------------------------------------------------------------------------
		function __construct(){
			include ('../../data.php');
			$this->db = $conn; 
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

					'rut' => number_format($rut,0)."-".$row['dv'],
					'nombre' => $row['nombre'],
					'apellido' => $row['apellido'],
					'mail' => $row['mail']

				);

			}
			$this->db = null;

			return $respuesta ;
		}
		
	}

 ?>