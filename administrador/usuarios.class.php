<?php 
	
	include('../../configuracion.php');
	include('../../data.php');
	
	class usuarios 
	{
		var $db;
	//--------------------------------------------------------------------------------------------------------
		function __construct(){
			//include ('../../data.php');
			//$this->db = $conn; 
			
			$configuracion = new Configuracion();
			$baseDato = new BaseDatos($configuracion);
			$this->db = $baseDato->conectarPDO();
		}
	//--------------------------------------------------------------------------------------------------------	
		function enviarInfo()
		{
			$rut = $_POST['rut'];

			$stmt = $this->db->prepare("SELECT * FROM usuarios_administracion WHERE rut = :rut");
			$stmt->bindParam(":rut", $rut);
			$stmt->execute();

			if($row = $stmt->fetch())
			{
				$arreglo = array();
				array_push($arreglo, $row['dv']);
				array_push($arreglo, $row['nombre']);
				array_push($arreglo, $row['apellido']);
				//array_push($arreglo, $row['password']);
				array_push($arreglo, $row['mail']);
				array_push($arreglo, $row['permiso_usuarios']);
				array_push($arreglo, $row['permiso_catalogo']);
				array_push($arreglo, $row['permiso_actividad']);
				array_push($arreglo, $row['permiso_recursos']);
				$this->db = null;
				return $arreglo;
			}
			$this->db = null;
		}
	//--------------------------------------------------------------------------------------------------------
		function eliminarUsuario()
		{
			$rut = $_POST['rut'];

			$stmt = $this->db->prepare("DELETE FROM usuarios_administracion WHERE rut = :rut");
			//$stmt->bindParam(":rut", $rut);
			$stmt->execute( array( ":rut" => $rut ));
			//$query->execute( array( ":id_to_delete" => $id_to_delete ) );
			$this->db = null;
			return true;
		}
	//--------------------------------------------------------------------------------------------------------
		function agregarUsuario()
		{
			$datos = $_POST['datos'] ;
			$datos = json_decode($datos);

			$rut = $datos[0];
			$div = $datos[1];
			$nombre =$datos[2];
			$apellido =$datos[3];
			$pass=md5($datos[4]);
			$mail=$datos[5];

			$as = $datos[6];
			$ec = $datos[7];
			$ear = $datos[8];
			$er =$datos[9];

			$stmt = $this->db->prepare("INSERT INTO usuarios_administracion VALUES (:rut, :div, :nombre, :apellido, :password, :mail, :permiso_usuarios, 
				:permiso_catalogo, :permiso_actividad, :permiso_recursos)");

			$stmt->bindParam(":rut", $rut);
			$stmt->bindParam(":div", $div);
			$stmt->bindParam(":nombre", $nombre);
			$stmt->bindParam(":apellido", $apellido);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":mail", $mail);
			$stmt->bindParam(":permiso_usuarios", $as);
			$stmt->bindParam(":permiso_catalogo", $ec);
			$stmt->bindParam(":permiso_actividad", $ear);
			$stmt->bindParam(":permiso_recursos", $er);
			$stmt->execute();
			$this->db = null;
			return true;

		}
	//--------------------------------------------------------------------------------------------------------
		function editarUsuario()
		{
			$datos = $_POST['datos'] ;
			$datos = json_decode($datos);

			$rut = $datos[0];
			$div = $datos[1];
			$nombre =$datos[2];
			$apellido =$datos[3];
			//$pass=$datos[4];
			$mail=$datos[4];

			$as = $datos[5];
			$ec = $datos[6];
			$ear = $datos[7];
			$er =$datos[8];


			$stmt = $this->db->prepare("UPDATE usuarios_administracion SET nombre=:nombre, apellido=:apellido, mail=:mail, permiso_usuarios=:permiso_usuarios, 
				permiso_catalogo=:permiso_catalogo, permiso_actividad=:permiso_actividad, permiso_recursos=:permiso_recursos WHERE rut=:rut");

			$stmt->bindParam(":rut", $rut);
			$stmt->bindParam(":nombre", $nombre);
			$stmt->bindParam(":apellido", $apellido);
			$stmt->bindParam(":mail", $mail);
			$stmt->bindParam(":permiso_usuarios", $as);
			$stmt->bindParam(":permiso_catalogo", $ec);
			$stmt->bindParam(":permiso_actividad", $ear);
			$stmt->bindParam(":permiso_recursos", $er);
			$stmt->execute();
			$this->db = null;
			return true;
		}
//--------------------------------------------------------------------------------------------------------
		function listarUsuarios(){
			
			$lista = array();
			foreach($this->db->query('SELECT * FROM usuarios_administracion') as $row)
				{
					$fila = array(
						$row["rut"],
						$row["rut"]."-".$row["dv"],
						$row["nombre"]." ".$row["apellido"],
						$row["mail"],
						//echo "<td><button onclick=editarUsuario('".$row["rut"]."')>Edit</button></td>";
						//echo "<td><button onclick=eliminarUsuario('".$row["rut"]."')>Eliminar</button></td>";

					);
					array_push($lista,$fila);
				}

			$this->db = null;
			return $lista;
		}
	}

 ?>