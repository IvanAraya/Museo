<?php
/*	
	$usuario = 'root';
	$passwd = '';
	$host = 'localhost' ;
	$db = 'museo' ;

	try {
		$conn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $usuario, $passwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		if($_SESSION['debug'])
			print $e->getMessage();
		else
			die();
	}
	
*/	
class BaseDatos{
	
	var $configuracion ;
	var $conexion ;
//-----------------------------------------------------------------
	function __construct($configuracion){
		$this->configuracion = $configuracion;
	}
//-----------------------------------------------------------------
	function conectarPDO(){
		try {			
			$this->conexion = new PDO('mysql:host='.$this->configuracion->dbHost.';dbname='.$this->configuracion->dbName.';charset=utf8', $this->configuracion->dbUser, $this->configuracion->dbPassword);
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->conexion ;
		} catch (PDOException $e) {
			//if($_SESSION['debug'])
			if($this->configuracion->debug)
				print $e->getMessage();
			else
				die();
		}
	}
//-----------------------------------------------------------------
}
	
	
?>