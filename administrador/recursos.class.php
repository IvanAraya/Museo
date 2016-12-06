<?php

include('../../configuracion.php');
include('../../data.php');

class recursos{
	
	var $db;
	//var $rutaAdministrador = 'C:/xampp/htdocs/museo/';
	
	function __construct(){
		//include ('../../data.php');
		//$this->db = $conn; 
		
		$this->configuracion = new Configuracion();
		$baseDato = new BaseDatos($this->configuracion);
		$this->db = $baseDato->conectarPDO();
	}

	function listarRecursos(){
		$stmt = $this->db->prepare("SELECT id_documento,titulo,ruta_documento,fecha_subida FROM documentos ORDER BY fecha_subida");
		$stmt->execute();
		$lista = array();
		
		while($row = $stmt->fetch()){
			$fechaS=date("d-m-Y",strtotime($row['fecha_subida']));
			$fila = array(
				$row['id_documento'],
				$row['titulo'],
				$row['ruta_documento'],
				$fechaS,
			);
			array_push($lista,$fila);
		}
		
		$this->db = null;
		return $lista;
	}

	function cargarRecurso(){
		$id = $_POST['id'];
		$stmt = $this->db->prepare("SELECT id_documento,titulo,descripcion,ruta_documento FROM documentos WHERE id_documento = :id");
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		if($row = $stmt->fetch()){
			$respuesta = array(
			'id' => $row['id_documento'],
			'titulo' => $row['titulo'],
			'descripcion' => $row['descripcion'],
			'archivo' => $row['ruta_documento'],
			);
		}
		$this->db = null;
		return $respuesta;
	}
		
	function agregarRecurso(){
		
		
		$consulta = "SELECT MAX(id_documento) FROM documentos";
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
		//$ruta = "recursos/".str_replace(" ","_",$_FILES['archivo']['name']);
		//$ruta_guardado = $this->rutaAdministrador."".$ruta;
		$ruta= $this->configuracion->urlRecursos.str_replace(" ","_",$_FILES['archivo']['name']);
		$ruta_guardado=$this->configuracion->rutaAplicacion.$ruta;
		$fecha = date('y-m-d');
		
		move_uploaded_file($ruta_temporal,$ruta_guardado);
		
		$consulta = "INSERT INTO documentos (id_documento,titulo,descripcion,ruta_documento,fecha_subida) VALUES (:id,:titulo,:descripcion,:archivo,:fecha)";
			
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
		
		
		$id = $_POST['id'];
		$cambiar = $_POST['cambiar'];
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$fecha = date('y-m-d');
		
		$stmt = $this->db->prepare("SELECT ruta_documento FROM documentos WHERE id_documento = :id");
		$stmt->execute(array( ":id" => $id ));
		if($row = $stmt->fetch()){
			$ruta = $row['ruta_documento'];
		}
		
		if($cambiar){
			//unlink($this->rutaAdministrador."".$ruta);
			unlink($this->configuracion->rutaAplicacion."".$ruta);
			$ruta_temporal = $_FILES['archivo']['tmp_name'];
			//$ruta = "recursos/".str_replace(" ","_",$_FILES['archivo']['name']);
			//$ruta_guardado = $this->rutaAdministrador."".$ruta;
			$ruta= $this->configuracion->urlRecursos.str_replace(" ","_",$_FILES['archivo']['name']);
			$ruta_guardado=$this->configuracion->rutaAplicacion.$ruta;
			move_uploaded_file($ruta_temporal,$ruta_guardado);
		}
		
		$consulta = "UPDATE documentos SET titulo = :titulo, descripcion = :descripcion, ruta_documento = :archivo, fecha_subida = :fecha WHERE id_documento = :id";
			
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
		//$rutaAdministrador = 'C:/xampp/htdocs/museo/';
		
		$id = $_POST['id'];	
		$stmt = $this->db->prepare("SELECT ruta_documento FROM documentos WHERE id_documento = :id");
		$stmt->execute(array( ":id" => $id ));
		if($row = $stmt->fetch()){
			$archivo = $row['ruta_documento'];
		}
		
		$stmt = $this->db->prepare("DELETE FROM documentos WHERE id_documento = :id");
		$stmt->execute(array( ":id" => $id ));
		$this->db = null;
		
		//unlink($this->rutaAdministrador."".$archivo);
		unlink($this->configuracion->rutaAplicacion.$archivo);
		return true;
	}
	
}

?>