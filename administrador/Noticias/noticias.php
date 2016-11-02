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

			if(isset($_GET['id'])){
				$id=$_GET['id'];
				///Datos conexion///
				$ip = "localhost";
				$usr = "root";
				$pass = "";
				$bd = "db_publicaciones";
				$publicado=1;

				///Creacion conexion///
				$conexion = mysqli_connect($ip,$usr,$pass,$bd);
				$accion="select * fom publicaciones where id='$id'";
				$resultado=mysqli_query($conexion,$accion);

				
				$retorno['id']=$resultado['id'];
				$retorno['titulo']=$resultado['titulo'];
				$retorno['fecha']=$resultado['fecha'];
				$retorno['contenido']=$resultado['contenido'];
				$retorno['img']=$resultado['img'];
				$retorno['b']=true;

				
			}
			return $retorno;
			
		}
	}



?>