<?php 

class catalogo{
	
	var $db;
	var $sinInfo = 'Sin Información' ;
	var $resultadosPagina = 40;
//--------------------------------------------------------------------------------------------------------	
	function __construct(){
		include ('../../data.php');
		$this->db = $conn; 
	}
//--------------------------------------------------------------------------------------------------------
	function listarMuestras(){
		
		$totalRegistros = 0;
		$consulta = "SELECT count(id) AS n FROM muestras";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute();
		while( $reg = $stmt->fetch() )
			$totalRegistros = $reg['n'];
		$paginas = ceil($totalRegistros / $this->resultadosPagina);
		$paginaActual = 1;
		
		$consulta = "SELECT id, descripcion, ruta_imagen FROM muestras ORDER BY descripcion ASC LIMIT ".$this->resultadosPagina ; 
		$stmt = $this->db->prepare($consulta);
		$stmt->execute();
		$respuesta = array(
			'paginas' => array(
				'totalResultados' => $totalRegistros,
				'totalPaginas'=> $paginas,
				'paginaActual' => $paginaActual
			),
			'resultados' => array()
		);

		while( $reg = $stmt->fetch() ){
			$imagen = '';
			if($reg['ruta_imagen'] == $this->sinInfo )
				$imagen = 'nodisponible.png';
			else
				$imagen = $reg['ruta_imagen'];
				
			array_push($respuesta['resultados'], array(
				'id' => $reg['id'], 
				'descripcion' => $reg['descripcion'],
				'imagen' => $imagen
			));
		}
		return $respuesta;
	}
//--------------------------------------------------------------------------------------------------------
	function llenarCombos(){
		
		$combos = array();	
		$combos['vitrinas'] = $this->obtenerDetalleTabla('vitrinas','descripcion','id_vitrina','descripcion');
		$combos['colecciones'] = $this->obtenerDetalleTabla('colecciones','descripcion','id_coleccion','descripcion');
		$combos['paises'] = $this->obtenerDetalleTabla('paises','descripcion','id_pais','descripcion');
		return $combos ;
	}
//--------------------------------------------------------------------------------------------------------
	function llenarRegion(){
		$id = $_POST['id'];
		return $this->obtenerDetalleTabla('regiones','descripcion','id_region','descripcion','id_pais',$id);
	}
//--------------------------------------------------------------------------------------------------------
	function llenarUbicacion(){
		$id = $_POST['id'];
		return $this->obtenerDetalleTabla('ubicaciones','descripcion','id_ubicacion','descripcion','id_region',$id);
	}
//--------------------------------------------------------------------------------------------------------
	function obtenerDetalleTabla($tabla,$campoOrden,$campoId,$campoValor,$claveForanea=null,$valorClave=null){

		if($claveForanea){
			$consulta = "SELECT * FROM ".$tabla." WHERE ".$claveForanea." = :id ORDER BY ".$campoOrden." ASC"; 
			$stmt = $this->db->prepare($consulta);
			$stmt->bindParam(':id',$valorClave);
		}else{
			$consulta = "SELECT * FROM ".$tabla." ORDER BY ".$campoOrden." ASC"; 
			$stmt = $this->db->prepare($consulta);
		}

		$stmt->execute();
		$salida = array(
			array(
				'id'=>'-1', 
				'texto'=>'Seleccione...'
			)
		);
		while( $reg = $stmt->fetch() ){
			array_push($salida,array(
				'id'=>$reg[$campoId], 
				'texto'=>$reg[$campoValor]
			));
		}
		return $salida ;
	}
//--------------------------------------------------------------------------------------------------------
	
//--------------------------------------------------------------------------------------------------------

}

?>