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
			//$nombre = $_POST['nombre'];  podemos recivir desde el formulario
			$saludo = array();
			//$saludo['nombre'] = $nombre;
			//$saludo['mensaje'] = "algun texto" ;
			$saludo['imagen'] = 'http://hombre.starmedia.com/imagenes/2012/12/facebook350.jpg';
			
			return $saludo;
		}
	//--------------------------------------------------------------------------------------------------------
		function guardar(){
			$titulo=$_POST['titulo'];
			$fecha=$_POST['fecha'];
			$cont=$_POST['contenido'];
			$id = 2;
			/*//Datos conexion///
			$ip = "localhost";
			$usr = "root";
			$pass = "";
			$bd = "db_publicaciones";
			$publicado=0;

			///Creacion conexion///
			$conexion = mysqli_connect($ip,$usr,$pass,$bd);
			$accion="insert into publicaciones values(NULL,'$titulo','$fecha','$cont','direccion imagen','$publicado')";
			mysqli_query($conexion,$accion);*/
			
			
			/*
			 * FALTA RECUPERAR EL ULTIMO id_actividad E INCREMENTARLO EN 1 PARA GENERAR EL NUEVO id_actividad.
			 * CUIDADO CUANDO LA TABLA ESTA VACÍA PORQUE ALGUNOS MOTORES DE BBDD DEVUELVEN NULL EN CASO DE NO HABER
			 * DATOS EN VEZ DE DEVOLVER 0 CUANDO SE CONSULTA POR EL ULTIMO ID.
			 */
			
			$accion="INSERT INTO actividades (id_actividad, titulo, texto, fecha) 
					VALUES (:id,:titulo,:cont,:fecha)";
			
			$stmt = $this->db->prepare($accion);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':titulo',$titulo);
			$stmt->bindParam(':fecha',$fecha);
			$stmt->bindParam(':cont',$cont);
			$stmt->execute();
			
			return true;
		}
	//--------------------------------------------------------------------------------------------------------
		function actualizar(){
			
			$id=$_POST['id'];
			$titulo=$_POST['titulo'];
			$fecha=$_POST['fecha'];
			$cont=$_POST['contenido'];

			$accion="UPDATE actividades SET titulo =:titulo , texto =:cont, fecha=:fecha WHERE id_actividad = :id";
			
			$stmt = $this->db->prepare($accion);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':titulo',$titulo);
			$stmt->bindParam(':fecha',$fecha);
			$stmt->bindParam(':cont',$cont);
			$stmt->execute();
			
			return true;
		}
	//--------------------------------------------------------------------------------------------------------
		function publicar(){
			$titulo=$_POST['titulo'];
			$fecha=$_POST['fecha'];
			$cont=$_POST['contenido'];

			///Datos conexion///
			$ip = "localhost";
			$usr = "root";
			$pass = "";
			$bd = "db_publicaciones";
			$publicado=1;

			///Creacion conexion///
			$conexion = mysqli_connect($ip,$usr,$pass,$bd);
			$accion="insert into publicaciones values(NULL,'$titulo','$fecha','$cont','direccion imagen','$publicado')";
			mysqli_query($conexion,$accion);
			return "ok";
			
		}
	//--------------------------------------------------------------------------------------------------------
		function verificar(){
			

			$retorno=array();
			$retorno['b']=false;

			if(isset($_POST['id'])){

				$id=$_POST['id'];
				/*/echo "<script>alert('"+$id+"')"
				//Datos conexion
				$ip = "localhost";
				$usr = "root";
				$pass = "";
				$bd = "db_publicaciones";
				$publicado=1;

				///Creacion conexion///
				$conexion = mysqli_connect($ip,$usr,$pass,$bd);
				$consulta="select * from publicaciones where id = $id" ;
				$resultados = mysqli_query($conexion,$consulta) ;

				while ($reg = mysqli_fetch_array($resultados)) {*/
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

			///Consulta///
			$consulta = "select * from actividades"; //no es necesario separar la consulta pero es ordenado
			//$registros = mysqli_query($conexion,$consulta); //es necesario guardar el resultado en una variable*/
			
			$stmt = $this->db->prepare($consulta);
			$stmt->execute();
			
			$resp = array();
			//$i=0;
			//while ($reg = mysqli_fetch_array($registros)) {
			while( $reg = $stmt->fetch() ){	
			
				array_push($resp, array($reg['id_actividad'], $reg['titulo'], $reg['fecha']));
				//$i++;
			}
			return $resp;
		}
	//--------------------------------------------------------------------------------------------------------
		function eliminarNoticia()
		{
			$id = $_POST['id'];

			$stmt = $this->db->prepare("DELETE FROM actividades WHERE id_Actividad = :id");
			//$stmt->bindParam(":rut", $rut);
			$stmt->execute( array( ":id" => $id ));
			//$query->execute( array( ":id_to_delete" => $id_to_delete ) );
			$this->db = null;
			return true;
		}
	//--------------------------------------------------------------------------------------------------------
	}



?>