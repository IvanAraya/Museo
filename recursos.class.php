<?php

class recursos{
	var $db;
	
	function __construct(){
		include ('../data.php');
		$this->db = $conn; 
	}

	function listarRecursos(){
		$stmt = $this->db->prepare("SELECT id_documento,titulo,descripcion,ruta_documento FROM documentos ORDER BY fecha_subida");
		$stmt->execute();
		$lista = array();
		
		while($row = $stmt->fetch()){
			$fila = array(
				$row['id_documento'],
				$row['titulo'],
				$row['descripcion'],
				$row['ruta_documento']
			);
			array_push($lista,$fila);
		}
		
		$this->db = null;
		return $lista;
	}
		
}

?>