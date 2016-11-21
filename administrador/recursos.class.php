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
		$rutaAdministrador = 'C:/xampp/htdocs/Museo-master/';
		
		$consulta = "SELECT MAX(id) FROM documentos";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute();
		$numero = mysql_query($consulta);
		if($row = $stmt->fetch()){
			$nmax = trim($row[0]);
		}
		
		$id = $nmax+1;
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$ruta_temporal = $_FILES['archivo']['tmp_name'];
		$ruta = "recursos/".$_FILES['archivo']['name'];
		$ruta_guardado = $rutaAdministrador."".$ruta;
		$fecha = date('y-m-d');
		
		move_uploaded_file($ruta_temporal,$ruta_guardado);
		
		$consulta = "INSERT INTO documentos (id,titulo,descripcion,archivo,fecha) VALUES (:id,:titulo,:descripcion,:archivo,:fecha)";
			
		$stmt = $this->db->prepare($consulta);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':titulo',$titulo);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':archivo',$ruta);
		$stmt->bindParam(':fecha',$fecha);	
		$stmt->execute();
				
		return true;
	}
	
	function editarRecurso(){
		$rutaAdministrador = 'C:/xampp/htdocs/Museo-master/';
		
		$id = $_POST['id'];
		$cambiar = $_POST['cambiar'];
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$fecha = date('y-m-d');
		
		$stmt = $this->db->prepare("SELECT archivo FROM documentos WHERE id = :id");
		$stmt->execute(array( ":id" => $id ));
		if($row = $stmt->fetch()){
			$ruta = $row['archivo'];
		}
		
		if($cambiar){
			unlink($rutaAdministrador."".$ruta);
			$ruta_temporal = $_FILES['archivo']['tmp_name'];
			$ruta = "recursos/".$_FILES['archivo']['name'];
			$ruta_guardado = $rutaAdministrador."".$ruta;
			move_uploaded_file($ruta_temporal,$ruta_guardado);
		}
		
		$consulta = "UPDATE documentos SET titulo = :titulo, descripcion = :descripcion, archivo = :archivo, fecha = :fecha WHERE id = :id";
			
		$stmt = $this->db->prepare($consulta);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':titulo',$titulo);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':archivo',$ruta);
		$stmt->bindParam(':fecha',$fecha);
		$stmt->execute();
				
		return true;
	}
	
	function eliminarRecurso(){
		$rutaAdministrador = 'C:/xampp/htdocs/Museo-master/';
		
		$id = $_POST['id'];	
		$stmt = $this->db->prepare("SELECT archivo FROM documentos WHERE id = :id");
		$stmt->execute(array( ":id" => $id ));
		if($row = $stmt->fetch()){
			$archivo = $row['archivo'];
		}
		
		$stmt = $this->db->prepare("DELETE FROM documentos WHERE id = :id");
		$stmt->execute(array( ":id" => $id ));
		$this->db = null;
		
		unlink($rutaAdministrador."".$archivo);
		return true;
	}
	
}

?>