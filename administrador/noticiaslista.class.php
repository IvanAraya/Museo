<?php 

class noticiaslista{
	
	
	function cargar(){
		
		
		$resp = array();
		$resp[0] = array('1','publicacion1');
		$resp[1] = array('2','publicacion2');
		
		return $resp;
		
	}
	
	function otra(){
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


				///Mostrando los datos///
				while ($reg = mysqli_fetch_array($registros)) {
					echo "<tr>";
						echo "<td>";
							echo $reg['titulo'];
						echo "</td>";

						echo "<td>";
							echo "<a href=noticias.html?id=".$reg['id'].">Editar</a>";
						echo "</td>";

						echo "<td>";
							echo "<a href=>Eliminar</a>";
						echo "</td>";

					echo "</tr>";
				}
	}
	
}

?>