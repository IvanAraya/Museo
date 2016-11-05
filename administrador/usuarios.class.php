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
	}
 ?>