<?php 
	class noticias{
		
		var $db;
	//--------------------------------------------------------------------------------------------------------	
		function __construct(){
			include ('../../data.php');
			$this->db = $conn; 
		}
	//--------------------------------------------------------------------------------------------------------	
		function subirImagen(){
			$saludo = array();
			$saludo['imagen'] = 'http://hombre.starmedia.com/imagenes/2012/12/facebook350.jpg';
			return $saludo;
		}
	//--------------------------------------------------------------------------------------------------------
		function guardar(){
			$titulo=$_POST['titulo'];
			$fecha=$_POST['fecha'];
			$cont=$_POST['contenido'];
			$fecha_actual=date("Y-m-d");
			$publicado=$_POST['check'];
			$id = 0;

			$max_id="select MAX(id_actividad) from actividades";
			$stmt1=$this->db->prepare($max_id);
			$stmt1->execute();

			if( $reg = $stmt1->fetch() ){
				$id = $reg['MAX(id_actividad)']+1;
			}

			$ruta_imagen="img/imgnoticias/".$id.".jpg";


			
			$accion="INSERT INTO actividades (id_actividad, titulo, texto, fecha,fecha_publicacion,publicado,ruta_imagen) 
					VALUES (:id,:titulo,:cont,:fecha,:fecha_p,:publicado,:ruta)";
			$stmt = $this->db->prepare($accion);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':titulo',$titulo);
			$stmt->bindParam(':fecha',$fecha);
			$stmt->bindParam(':cont',$cont);
			$stmt->bindParam(':fecha_p',$fecha_actual);
			$stmt->bindParam(':publicado',$publicado);
			$stmt->bindParam(':ruta',$ruta_imagen);
			$stmt->execute();
			return true;
		}
	//--------------------------------------------------------------------------------------------------------
		function actualizar(){
			// me falta ver como manejar la imagen
			$id=$_POST['id'];
			$titulo=$_POST['titulo'];
			$fecha=$_POST['fecha'];
			$cont=$_POST['contenido'];
			$publicado=$_POST['check'];

			$accion="UPDATE actividades SET titulo =:titulo , texto =:cont, fecha=:fecha ,publicado=:publicado WHERE id_actividad = :id";	
			$stmt = $this->db->prepare($accion);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':titulo',$titulo);
			$stmt->bindParam(':fecha',$fecha);
			$stmt->bindParam(':cont',$cont);
			$stmt->bindParam(':publicado',$publicado);
			$stmt->execute();
			return true;
		}
	//--------------------------------------------------------------------------------------------------------

		function verificar(){
			$retorno=array();
			$retorno['b']=false;
			if(isset($_POST['id'])){
				$id=$_POST['id'];
				$stmt = $this->db->prepare("select * from actividades where id_actividad = :id");
				$stmt->bindParam(":id", $id);
				$stmt->execute();
				
				$retorno = array();
				while( $reg = $stmt->fetch() ){	
					$retorno['id']	   	 = $reg['id_actividad'];
					$retorno['titulo']	 = $reg['titulo'];
					$retorno['fecha']	 = $reg['fecha'];
					$retorno['contenido']= $reg['texto'];
					$retorno['img']		 = $reg['ruta_imagen'];
					$retorno['publicado']= $reg['publicado'];
					$retorno['b']		 = true;
				}	
			}
			return $retorno;	
		}
	//--------------------------------------------------------------------------------------------------------
		function cargar(){
			$consulta = "select * from actividades"; 
			$stmt = $this->db->prepare($consulta);
			$stmt->execute();
			$resp = array();
			$estado="oculto";

			while( $reg = $stmt->fetch() ){

				if($reg['publicado']==1)
					$estado="publicado";
				else
					$estado="oculto";



				array_push($resp, array($reg['id_actividad'], $reg['titulo'], $reg['fecha'],$estado));
			}
			return $resp;
		}
	//--------------------------------------------------------------------------------------------------------
		function eliminarNoticia()
		{
			$id = $_POST['id'];
			$stmt = $this->db->prepare("DELETE FROM actividades WHERE id_Actividad = :id");
			$stmt->execute( array( ":id" => $id ));
			$this->db = null;
			return true;
		}
	//--------------------------------------------------------------------------------------------------------
	}



?>
