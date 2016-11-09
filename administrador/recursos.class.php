<?php

class recursos{
	
	var $db ;	
//--------------------------------------------------------------------------------------------------------
	function __construct(){
		include ('../../data.php');
		$this->db = $conn; 
	}
//--------------------------------------------------------------------------------------------------------	
	function obtenerRecurso(){
		
		$id = $_POST['id'];		
		$stmt = $this->db->prepare("SELECT * FROM documentos WHERE id = :usuario");
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		
		if($row = $stmt->fetch()){
			$resp = array(
				'id' => $row['id_documento'],
				'titulo' => $row['titulo'],
				'fecha' => $row['fecha_subida'],
				'descripcion' => $row['descripción'],
				'ruta' => $row['ruta_documento']
			);
		}
		
		$this->db = null;
		return $resp;
	}
//--------------------------------------------------------------------------------------------------------
	function listarRecursos(){
		
		$stmt = $this->db->prepare("SELECT id_documento, titulo, fecha_subida FROM documentos ORDER BY fecha_subida");
		$stmt->execute();
		$lista = array();
		if($row = $stmt->fetch()){
			$fila = array(
				$row['id_documento'],
				$row['titulo'],
				$row['fecha_subida']
			);
			array_push($lista,$fila);
		}
		
		$this->db = null;
		return $lista;
	}
//--------------------------------------------------------------------------------------------------------
	function nuevoRecurso(){
	
	}
//--------------------------------------------------------------------------------------------------------
	function editarRecurso(){
	
	}
//--------------------------------------------------------------------------------------------------------
	function eliminarRecurso(){
		return true;
	}
//--------------------------------------------------------------------------------------------------------
}

?>