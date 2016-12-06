<?php 

	include('../../configuracion.php');
	include('../../data.php');
	
	class mantenedor{
		
		var $db;
	//--------------------------------------------------------------------------------------------------------
		function __construct(){
			
			$configuracion = new Configuracion();
			$baseDato = new BaseDatos($configuracion);
			$this->db = $baseDato->conectarPDO();
		}
	//-------------------------------------------------------------------------------------------------------
		function guardarRegistro(){
			$id = $_POST['id'] ;
			$valor = addslashes($_POST['valor']) ;
			$predecesor = addslashes($_POST['predecesor']) ;
			$tabla = addslashes($_POST['entidad']) ;
			$camposTabla = $this->obtenerCampoClave($tabla) ;
			
			if($id == ""){
				$stmt = $this->db->prepare("SELECT MAX(".$camposTabla['pk'].") FROM ".$tabla);
				$stmt->execute();
				while($row = $stmt->fetch(PDO::FETCH_NUM)){
					$id = $row[0];
					$id++;
				}
				if($predecesor!= ""){
					$sql = "INSERT INTO ".$tabla."(".$camposTabla['pk'].",".$camposTabla['fk'].",descripcion ) VALUES (:id, :predecesor, :valor)" ;
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':predecesor',$predecesor);
				}else{
					$sql = "INSERT INTO ".$tabla."(".$camposTabla['pk'].",descripcion ) VALUES (:id, :valor)" ;
					$stmt = $this->db->prepare($sql);
				}
				try{

					
					$stmt->bindParam(':id',$id);
					$stmt->bindParam(':valor',$valor);					
					$stmt->execute();
					
					return array('resultado'=> true);
				}catch(Exception $err){
					return array('resultado'=> false,'mensaje'=>'No se pudo ingresar el registro.'.$err->getMessage());
				}				
			}else{
				$sql = "UPDATE ".$tabla." SET descripcion = :valor WHERE ".$camposTabla['pk']." = :id ;" ;
				try{
					
					$stmt2 = $this->db->prepare($sql);
					$stmt2->bindParam(':id',$id);
					$stmt2->bindParam(':valor',$valor);
					$stmt2->execute();
					//echo "actualizar";
					return array('resultado'=> true);
				}catch(Exception $err){
					return array('resultado'=> false,'mensaje'=>'No se pudo ingresar el registro.');
				}
			}
			
		}
	//--------------------------------------------------------------------------------------------------------
		function eliminarRegistro(){
			$id = $_POST['id'] ;
			$tabla = addslashes($_POST['entidad']) ;
			$camposTabla = $this->obtenerCampoClave($tabla) ;
			$sql = "DELETE FROM ".$tabla." WHERE ".$camposTabla['pk']." = :id ;" ;
				try{

					$stmt2 = $this->db->prepare($sql);
					$stmt2->bindParam(':id',$id);
					$stmt2->execute();
					
					return array('resultado'=> true);
				}catch(Exception $err){
					return array('resultado'=> false,'mensaje'=>'No se pudo eliminar el registro. Verifique que no este relacionado actualmente con otros registros.');
				}			
			
		}
	//--------------------------------------------------------------------------------------------------------
		function recuperarDatos(){
			
			$tabla = addslashes($_POST['entidad']);
			if(isset($_POST['predecesor']))
				$predecesor = addslashes($_POST['predecesor']);
			$camposTabla = $this->obtenerCampoClave($tabla);
			
			$where = '';
			if($camposTabla['fk'])
				$where = " WHERE ".$camposTabla['fk']."=".$predecesor ;
			
			$stmt = $this->db->prepare("SELECT ".$camposTabla['pk'].", descripcion FROM ".$tabla.$where);
			$stmt->execute();
			
			$respuesta = array();
			while($row = $stmt->fetch(PDO::FETCH_NUM)){
				array_push($respuesta,$row);
			}
			$this->db = null;

			return $respuesta ;
		}
	//--------------------------------------------------------------------------------------------------------
		function obtenerCampoClave($tabla){
			
			$camposTabla = null;
			switch($tabla){
				case 'paises':
					$camposTabla = array('pk'=>'id_pais','fk'=>false); break;
				case 'regiones':
					$camposTabla = array('pk'=>'id_region','fk'=>'id_pais'); break;
				case 'regiones':
					$camposTabla = array('pk'=>'id_region','fk'=>'id_pais'); break;
				case 'ubicaciones':
					$camposTabla = array('pk'=>'id_ubicacion','fk'=>'id_region'); break;	
				case 'adquisiciones':
					$camposTabla = array('pk'=>'id_adquisiciones','fk'=>null); break;
				case 'colecciones':
					$camposTabla = array('pk'=>'id_coleccion','fk'=>null); break;	
			}
			return $camposTabla;
		}
		
	}

?>