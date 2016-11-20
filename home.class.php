<?php

class home{
	
	var $db;
	function __construct(){
		
		include ('../data.php');
		$this->db = $conn; 
	}
	//--------------------------------------------------------------------------------------------------------
	function cargarNoticias(){
		$consulta = "SELECT * FROM actividades WHERE publicado = 1 ORDER BY fecha DESC LIMIT 3"; 
		$stmt = $this->db->prepare($consulta);
		$stmt->execute();
		$resp = array();

		while( $reg = $stmt->fetch() ){
			$noticia = array(
				'id' => $reg['id_actividad'],
				'imagen' => $reg['ruta_imagen'] ,
				'titulo' => $reg['titulo'],
				'cuerpo' =>$reg['texto'],
				'fecha' => $reg['fecha']
			);
			array_push($resp, $noticia);
		}
		return $resp;
	}
	//--------------------------------------------------------------------------------------------------------
}

?>