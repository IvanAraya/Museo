



<!DOCTYPE html>
<html>
	<head>
		<title></title>
		  <link rel="stylesheet" type="text/css" href="css/estilo.css">

		<script type="text/javascript">
			function nueva(){
				window.location="noticias.html";
			}
		</script>

	</head>
	<body >
		<div id="formulario">
			<h2>Publicaciones</h2><hr>
			<table border="2px">
				<tr>
					<td width="500px">
						<p>Titulo</p>
					</td>
					<td colspan="2">	
						<p>Opciones</p>					
					</td>
				</tr>
			<?php 
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
			?>
			</table>

			<input type="button" name="nuevo" value="Nueva publicaion" onclick="nueva()">


		</div>



	</body>
</html>