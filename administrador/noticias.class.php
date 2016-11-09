<?php 
	class noticias{
		function subirImagen(){
			//$nombre = $_POST['nombre'];  podemos recivir desde el formulario
			$saludo = array();
			//$saludo['nombre'] = $nombre;
			//$saludo['mensaje'] = "algun texto" ;
			$saludo['imagen'] = 'http://hombre.starmedia.com/imagenes/2012/12/facebook350.jpg';
			
			return $saludo;
		}


		function guardar(){
			$titulo=$_POST['titulo'];
			$fecha=$_POST['fecha'];
			$cont=$_POST['contenido'];

			///Datos conexion///
			$ip = "localhost";
			$usr = "root";
			$pass = "";
			$bd = "db_publicaciones";
			$publicado=0;

			///Creacion conexion///
			$conexion = mysqli_connect($ip,$usr,$pass,$bd);
			$accion="insert into publicaciones values(NULL,'$titulo','$fecha','$cont','direccion imagen','$publicado')";
			mysqli_query($conexion,$accion);
			return "ok";
		}


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




		function verificar(){
			

			$retorno=array();
			$retorno['b']=false;

			if(isset($_POST['id'])){



				$id=$_POST['id'];
				// echo "<script>alert('"+$id+"')</script>";
				///Datos conexion///
				$ip = "localhost";
				$usr = "root";
				$pass = "";
				$bd = "db_publicaciones";
				$publicado=1;

				///Creacion conexion///
				$conexion = mysqli_connect($ip,$usr,$pass,$bd);
				$consulta="select * from publicaciones where id = $id" ;
				$resultados = mysqli_query($conexion,$consulta) ;

				while ($reg = mysqli_fetch_array($resultados)) {
					$retorno['id']	   	 = $reg['id'];
					$retorno['titulo']	 = $reg['titulo'];
					$retorno['fecha']	 = $reg['fecha'];
					$retorno['contenido']= $reg['contenido'];
					$retorno['img']		 = $reg['img'];
					$retorno['b']		 = true;
				}
				
			}
			return $retorno;
			
		}
	}



?>