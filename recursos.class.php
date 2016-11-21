<?php

class recursos{
	var $db;
	
	function __construct(){
		include ('../data.php');
		$this->db = $conn; 
	}

	function listarRecursos(){
		$stmt = $this->db->prepare("SELECT id,titulo,descripcion,archivo FROM documentos ORDER BY fecha");
		$stmt->execute();
		$lista = array();
		
		while($row = $stmt->fetch()){
			$fila = array(
				$row['id'],
				$row['titulo'],
				$row['descripcion'],
				$row['archivo']
			);
			array_push($lista,$fila);
		}
		
		$this->db = null;
		return $lista;
	}
		
}

?>