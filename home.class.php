<?php

include('../configuracion.php');
include('../data.php');

class home{
	
	var $db;
	var $configuracion ;
	function __construct(){
		
		$this->configuracion = new Configuracion();
		$baseDato = new BaseDatos($this->configuracion);
		$this->db = $baseDato->conectarPDO();
	}
	//--------------------------------------------------------------------------------------------------------
	function cargarBanner(){
		
		$banner = array();
		$directorio = opendir($this->configuracion->rutaAplicacion.$this->configuracion->urlImagenesBanner); //ruta actual
		while ($archivo = readdir($directorio)){
			 if (!is_dir($archivo)){
				  array_push($banner,$this->configuracion->urlImagenesBanner.$archivo);
			 }
		}
		return $banner;
	}
	//--------------------------------------------------------------------------------------------------------
	function cargarNoticias(){
		$consulta = "SELECT * FROM actividades WHERE publicado = 1 ORDER BY fecha DESC LIMIT 3"; 
		$stmt = $this->db->prepare($consulta);
		$stmt->execute();
		$resp = array();

		while( $reg = $stmt->fetch() ){
			$fechaS=date("d-m-Y",strtotime($reg['fecha'])); 
			$noticia = array(
				'id' => $reg['id_actividad'],
				'imagen' => $reg['ruta_imagen'].'?'.time() ,
				'titulo' => $reg['titulo'],
				'cuerpo' =>$reg['texto'],
				'fecha' => $fechaS
			);
			array_push($resp, $noticia);
		}
		return $resp;
	}
	//--------------------------------------------------------------------------------------------------------
}

?>