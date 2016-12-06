<?php 

	//$db;
	//include ('../data.php');
	//$db = $conn; 
	
	include('../configuracion.php');
	include('../data.php');
	
	$configuracion = new Configuracion();
	$baseDato = new BaseDatos($configuracion);
	$db = $baseDato->conectarPDO();


	//captcha check
	$b_captcha = false;
	$captcha = md5($_POST['captcha']);
	session_start();
	$digit = $_SESSION['code'];
	if( $captcha == $digit){
		$b_captcha=true;
	}
	///////////////////////////




	if($b_captcha){
		$user=$_POST['rut'];
		$pass=$_POST['pass'];

		$user=str_replace('.', '', $user);
		$user=str_replace('-', '', $user);
		$largo=strlen($user);
		$numero=substr($user, 0,($largo-1));
		$dv=substr($user, $largo-1);

		$stmt = $db->prepare("SELECT * FROM usuarios_administracion WHERE rut = :usuario and password=:pass");
		$stmt->bindParam(':usuario',$numero);
		$stmt->bindParam(':pass',md5($pass));
		$stmt->execute();


		if($row = $stmt->fetch()){
			session_start();
			$_SESSION['rut'] = $row['rut'];
			$_SESSION['p_usuarios'] = $row['permiso_usuarios'];
			$_SESSION['p_catalogo'] = $row['permiso_catalogo'];
			$_SESSION['p_actividad'] = $row['permiso_actividad'];
			$_SESSION['p_recursos'] = $row['permiso_recursos'];
			header('location:index.php');
		}else{
			//session_destroy();
			echo '<script language="javascript">alert("Nombre de Usuario o Contraseña incorrectos.");window.location.href="login.php";</script>'; 
		}
	}else{
		echo '<script language="javascript">alert("Codigo Captcha incorrecto.");window.location.href="login.php";</script>';
	}


	



 ?>