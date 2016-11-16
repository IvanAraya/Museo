<?php

class recursos{

	var $db;
	
	function __construct(){
		include ('../../data.php');
		$this->db = $conn; 
	}
	
function obtenerRecurso(){
	$id = $_POST['id'];		
	
	$stmt = $this->db->prepare("SELECT * FROM documentos WHERE id = :id");
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	
	if($row = $stmt->fetch()){
		$resp = array(
		'id' => $row['id'],
		'titulo' => $row['titulo'],
		'ruta' => $row['archivo'],
		'descripcion' => $row['descripción'],
		'fecha' => $row['fecha'],
		);
	}
	
	$this->db = null;
	return $resp;
}

function listarRecursos(){
	
	$stmt = $this->db->prepare("SELECT id,titulo,archivo,fecha FROM documentos ORDER BY fecha");
	$stmt->execute();
	$lista = array();
	
	while($row = $stmt->fetch()){
		$fila = array(
			$row['id'],
			$row['titulo'],
			$row['archivo'],
			$row['fecha'],
		);
		array_push($lista,$fila);
	}
	
	$this->db = null;
	return $lista;
}

function cargarRecurso(){

	$arreglo=array();
	
	$arreglo['id']= 1;
	$arreglo['titulo']='prueba1';
	$arreglo['descripcion']='descripcion1';
	$arreglo['archivo']='archivo1';

	return $arreglo;
}

function agregarRecurso(){

}

function editarRecurso(){

}

function eliminarRecurso(){
	$id = $_POST['id'];	
	$stmt = $this->db->prepare("DELETE FROM documentos WHERE id = :id");
	$stmt->execute( array( ":id" => $id ));
	$this->db = null;
	return true;	
}

}

?>