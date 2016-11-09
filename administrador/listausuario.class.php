<?php 
	//include("../data.php");

	/**
	* 
	*/



	class Usuarios 
	{
		function enviarInfo()
		{
			$rut = $_POST['rut'];
			
			$conn = null;
			$usuario = 'root';
			$passwd = '';

			try {
				$conn = new PDO('mysql:host=localhost;dbname=Museo;charset=utf8', $usuario, $passwd);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
			}

			$stmt = $conn->prepare("SELECT * FROM usuarios_administracion WHERE rut = :rut");
			$stmt->bindParam(":rut", $rut);
			$stmt->execute();

			if($row = $stmt->fetch())
			{
				$arreglo = array();
				array_push($arreglo, $row['dv']);
				array_push($arreglo, $row['nombre']);
				array_push($arreglo, $row['apellido']);
				array_push($arreglo, $row['password']);
				array_push($arreglo, $row['mail']);
				array_push($arreglo, $row['permiso_usuarios']);
				array_push($arreglo, $row['permiso_catalogo']);
				array_push($arreglo, $row['permiso_actividad']);
				array_push($arreglo, $row['permiso_recursos']);
				$conn = null;
				return $arreglo;
			}
			
		}

		function eliminarUsuario()
		{
			$rut = $_POST['rut'];

			$conn = null;
			$usuario = 'root';
			$passwd = '';

			try {
				$conn = new PDO('mysql:host=localhost;dbname=Museo;charset=utf8', $usuario, $passwd);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
			}


			$stmt = $conn->prepare("DELETE FROM usuarios_administracion WHERE rut = :rut");
			//$stmt->bindParam(":rut", $rut);
			$stmt->execute( array( ":rut" => $rut ));
			//$query->execute( array( ":id_to_delete" => $id_to_delete ) );

			return true;
		}

		function agregarUsuario()
		{
			$datos = $_POST['datos'] ;
			$datos = json_decode($datos);

			$rut = $datos[0];
			$div = $datos[1];
			$nombre =$datos[2];
			$apellido =$datos[3];
			$pass=$datos[4];
			$mail=$datos[5];

			$as = $datos[6];
			$ec = $datos[7];
			$ear = $datos[8];
			$er =$datos[9];


			$conn = null;
			$usuario = 'root';
			$passwd = '';

			try {
				$conn = new PDO('mysql:host=localhost;dbname=Museo;charset=utf8', $usuario, $passwd);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
			}

			$stmt = $conn->prepare("INSERT INTO usuarios_administracion VALUES (:rut, :div, :nombre, :apellido, :password, :mail, :permiso_usuarios, 
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

		}

		function editarUsuario()
		{
			$datos = $_POST['datos'] ;
			$datos = json_decode($datos);

			$rut = $datos[0];
			$div = $datos[1];
			$nombre =$datos[2];
			$apellido =$datos[3];
			$pass=$datos[4];
			$mail=$datos[5];

			$as = $datos[6];
			$ec = $datos[7];
			$ear = $datos[8];
			$er =$datos[9];


			$conn = null;
			$usuario = 'root';
			$passwd = '';

			try {
				$conn = new PDO('mysql:host=localhost;dbname=Museo;charset=utf8', $usuario, $passwd);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
			}


			$stmt = $conn->prepare("UPDATE usuarios_administracion SET nombre=:nombre, apellido=:apellido, password=:password, mail=:mail, permiso_usuarios=:permiso_usuarios, 
				permiso_catalogo=:permiso_catalogo, permiso_actividad=:permiso_actividad, permiso_recursos=:permiso_recursos WHERE rut=:rut");

			$stmt->bindParam(":rut", $rut);
			$stmt->bindParam(":nombre", $nombre);
			$stmt->bindParam(":apellido", $apellido);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":mail", $mail);
			$stmt->bindParam(":permiso_usuarios", $as);
			$stmt->bindParam(":permiso_catalogo", $ec);
			$stmt->bindParam(":permiso_actividad", $ear);
			$stmt->bindParam(":permiso_recursos", $er);
			$stmt->execute();
		}
	}

 ?>