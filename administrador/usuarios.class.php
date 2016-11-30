<?php 
	
	include('../../configuracion.php');
	include('../../data.php');
	require 'phpmailer/PHPMailerAutoload.php';
	
	class usuarios 
	{
		var $db;
		var $configuracion ;
	//--------------------------------------------------------------------------------------------------------
		function __construct(){
			//include ('../../data.php');
			//$this->db = $conn; 
			
			$this->configuracion = new Configuracion();
			$baseDato = new BaseDatos($this->configuracion);
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
			
			$usuario = new Usuario();
			
			$usuario->rut = $datos[0];
			$usuario->div = $datos[1];
			$usuario->nombre =$datos[2];
			$usuario->apellido =$datos[3];
			$usuario->pass = $this->generateRandomString(8);
			$pass=md5( $usuario->pass );
			$usuario->mail=$datos[5];

			$as = $datos[6];
			$ec = $datos[7];
			$ear = $datos[8];
			$er =$datos[9];

			$stmt = $this->db->prepare("INSERT INTO usuarios_administracion VALUES (:rut, :div, :nombre, :apellido, :password, :mail, :permiso_usuarios, 
				:permiso_catalogo, :permiso_actividad, :permiso_recursos)");

			$stmt->bindParam(":rut", $usuario->rut);
			$stmt->bindParam(":div", $usuario->div);
			$stmt->bindParam(":nombre", $usuario->nombre);
			$stmt->bindParam(":apellido", $usuario->apellido);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":mail", $usuario->mail);
			$stmt->bindParam(":permiso_usuarios", $as);
			$stmt->bindParam(":permiso_catalogo", $ec);
			$stmt->bindParam(":permiso_actividad", $ear);
			$stmt->bindParam(":permiso_recursos", $er);
			$stmt->execute();
			$this->db = null;
			if(!$this->enviarCorreo($usuario))
				return false;
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
//--------------------------------------------------------------------------------------------------------
		function enviarCorreo($usuario){
			
			if(!$this->configuracion->correoHabilitado)
				return false;
			
			$mail = new PHPMailer;

			//$mail->SMTPDebug = 3;                               // Enable verbose debug output

			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);

			$mail->isSMTP();                                      
			$mail->SMTPAuth = true; 
			$mail->Host = $this->configuracion->mailSMTPHost;			
			$mail->Username = $this->configuracion->mailUsername;	
			$mail->Password = $this->configuracion->mailPassword;	 
			$mail->SMTPSecure = $this->configuracion->mailSMTPSecure;	  
			$mail->Port = $this->configuracion->mailPort;	   

			$mail->setFrom($this->configuracion->mailUsername);
			$mail->addAddress($usuario->mail);     
			$mail->isHTML(true);                                  

			$mail->Subject = 'Nueva cuenta de usuario.';
			$mail->Body    = 'Estimado(a) ' . $usuario->nombre . ' ' . $usuario->apellido . '<br><br>'.
									'Su cuenta de usuario para el sitio web del Museo Mineral&oacute;gico Ignacio Domeyko ha sido creada exitosamente.<br>'.
									'Los datos para el inicio de sesi&oacute;n son:<br><br>'.
									'Usuario: ' . $usuario->rut . '-' . $usuario->div . '<br>'.
									'Contrase&ntilde;a: ' . $usuario->pass . '<br><br>'.
									'Le recordamos que debe cambiar su contrase&ntilde;a en la secci&oacute;n "Perfil".<br><br>'.
									'Museo Mineral&oacute;gico Ignacio Domeyko.' ;
									
			$mail->AltBody = "Estimado(a) " . $usuario->nombre . " " . $usuario->apellido . "\r\n\r\n".
									"Su cuenta de usuario para el sitio web del Museo Mineralogico Ignacio Domeyko ha sido creada exitosamente.\r\n".
									"Los datos para el inicio de sesion son:\r\n\r\n".
									"Usuario: " . $usuario->rut . "-" . $usuario->div . "\r\n".
									"Contraseña: " . $usuario->pass . "\r\n\r\n".
									"Le recordamos que debe cambiar su contraseña en la seccion \"Perfil\".\r\n\r\n".
									"Museo Mineralogico Ignacio Domeyko." ;

			if(!$mail->send()) {
				 //echo 'Message could not be sent.';
				 //echo 'Mailer Error: ' . $mail->ErrorInfo;
				 return false ;
			} else {
				 //echo 'Message has been sent';
				 return true;
			}
			
		}
//--------------------------------------------------------------------------------------------------------
		function generateRandomString($length = 10) { 
			 return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
		} 
//--------------------------------------------------------------------------------------------------------

	}
/*********************************************************************************/
class Usuario{
	var $rut ;
	var $div ;
	var $nombre ;
	var $apellido ;
	var $pass ;
	var $mail ;
}
 ?>