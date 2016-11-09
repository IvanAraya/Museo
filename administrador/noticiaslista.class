<?php 

class noticiaslista{
	
	
	function cargar(){
		///Datos conexion///
		$ip = "localhost";
		$usr = "root";
		$pass = "";
		$bd = "db_publicaciones";

		///Creacion conexion///
		$conexion = mysqli_connect($ip,$usr,$pass,$bd);

		///Consulta///
		$consulta = "select * from publicaciones"; //no es necesario separar la consulta pero es ordenado
		$registros = mysqli_query($conexion,$consulta); //es necesario guardar el resultado en una variable
	
		$resp = array();
		$i=0;
		while ($reg = mysqli_fetch_array($registros)) {
			$resp[$i] = array($reg['id'],$reg['titulo']);
			$i++;
		}
		return $resp;
	}
}

?>