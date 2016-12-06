<?php 

class noticiaslista{
	function cargarLista(){
		function cargar(){
			$consulta = "select * from actividades"; 
			$stmt = $this->db->prepare($consulta);
			$stmt->execute();
			$resp = array();

			while( $reg = $stmt->fetch() ){	
				array_push($resp, array($reg['id_actividad'], $reg['titulo'], $fechaS,$reg['publicado']));
			}
			return $resp;
		}
	}
}

?>