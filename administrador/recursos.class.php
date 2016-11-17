<?php

class recursos{
	var $db;
	
	function __construct(){
		include ('../../data.php');
		$this->db = $conn; 
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
		$id = $_POST['id'];
		$stmt = $this->db->prepare("SELECT id,titulo,descripcion,archivo FROM documentos WHERE id = :id");
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		if($row = $stmt->fetch()){
			$respuesta = array(
			'id' => $row['id'],
			'titulo' => $row['titulo'],
			'descripcion' => $row['descripcion'],
			'archivo' => $row['archivo'],
			);
		}
		$this->db = null;
		return $respuesta;
	}

	function agregarRecurso(){
		$id = 10;
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$archivo = $_POST['archivo'];
		$fecha = date('y-m-d');
		
		$consulta = "INSERT INTO documentos (id,titulo,descripcion,archivo,fecha) VALUES (:id,:titulo,:descripcion,:archivo,:fecha)";
			
		$stmt = $this->db->prepare($consulta);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':titulo',$titulo);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':archivo',$archivo);
		$stmt->bindParam(':fecha',$fecha);	
		$stmt->execute();
			
		return true;
	}

	function editarRecurso(){
		$id = $_POST['id'];
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$archivo = $_POST['archivo'];
		$fecha = date('y-m-d');

		$consulta = "UPDATE documentos SET titulo = :titulo, descripcion = :descripcion, archivo = :archivo, fecha = :fecha WHERE id = :id";
			
		$stmt = $this->db->prepare($consulta);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':titulo',$titulo);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':archivo',$archivo);
		$stmt->bindParam(':fecha',$fecha);
		$stmt->execute();
			
		return true;
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