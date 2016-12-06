<?php 

include('../configuracion.php');
include('../data.php');

class catalogo{
	
	var $db;
	var $configuracion ;
	var $sinInfo = 'Sin Información' ;
	var $imagenSinInformacion = 'nodisponible.png' ;
	var $resultadosPagina = 40;
//--------------------------------------------------------------------------------------------------------	
	function __construct(){

		
		$this->configuracion = new Configuracion();
		$baseDato = new BaseDatos($this->configuracion);
		$this->db = $baseDato->conectarPDO();
	}
//--------------------------------------------------------------------------------------------------------
	function listarMuestras(){
		
		$q = "" ;
		$numMuestra = "" ;
		$vitrina = -1 ;
		$coleccion = -1 ;
		$pais = -1 ;
		$region = -1 ;
		$ubicacion = -1 ;
		$paginaActual = 1 ;
		
		if(isset($_POST['q'])){
			$q = addslashes($_POST['q']);
			$numMuestra = addslashes($_POST['txtNumMuestra']);
			$vitrina = addslashes($_POST['cmbVitrinas']) ;
			$coleccion = addslashes($_POST['cmbColecciones']) ;
			$pais = addslashes($_POST['cmbPais']) ;
			$region = addslashes($_POST['cmbRegion']) ;
			$ubicacion = addslashes($_POST['cmbUbicacion']) ;
			$paginaActual = addslashes($_POST['pagina']);
		}
		$select1 = "SELECT m.id, m.descripcion, m.ruta_imagen " ;
		$select2 = "SELECT count(m.id) AS n " ;
		$from = "FROM 	muestras AS m 
						INNER JOIN caracteristica_tipo_muestra AS ctm ON m.id_caracteristica_tipo_muestra = ctm.id_caractristica_tipo_muestra
						INNER JOIN tipo_muestra AS tm ON ctm.id_tipo_muestra = tm.id_tipo_muestra
						INNER JOIN ubicaciones AS u ON m.id_ubicacion = u.id_ubicacion
						INNER JOIN regiones AS r ON u.id_region = r.id_region AND u.id_region = r.id_region
						INNER JOIN paises AS p ON r.id_pais = p.id_pais
						INNER JOIN adquisiciones AS a ON a.id_adquisiciones = m.id_adquicicion " ;		
		$order = "ORDER BY m.descripcion ASC " ;
		
		$condicion = array();
		if($q != ""){
			$cond1 = " m.descripcion LIKE '%".$q."%' OR m.formula_quimica LIKE '%".$q."%' OR tm.descripcion LIKE '%".$q."%' OR 
						ctm.descripcion LIKE '%".$q."%' OR a.descripcion LIKE '%".$q."%' " ;
			array_push($condicion,$cond1);
		}
		
		
		$cond2 = "" ;
		if($numMuestra != ""){
			$cond2 = " m.numero_muetra = $numMuestra ";
		}else{
			$busquedaAvanzada = array();
			if($vitrina != -1)	
				array_push($busquedaAvanzada," m.id_vitrina = $vitrina ");
			if($coleccion != -1)	
				array_push($busquedaAvanzada," m.id_coleccion = $coleccion ");
			if($pais != -1)	
				array_push($busquedaAvanzada," p.id_pais = $pais ");
			if($region != -1)	
				array_push($busquedaAvanzada," r.id_region = $region ");
			if($ubicacion != -1)	
				array_push($busquedaAvanzada," u.id_ubicacion = $ubicacion ");
			
			if(count($busquedaAvanzada) > 0)
				$cond2 = implode(" AND " , $busquedaAvanzada);

		}
		if($cond2 != "")
			array_push($condicion,$cond2);
		
		$where = implode(" AND " , $condicion);
		if($where != "")
			$where = " WHERE ".$where ;
		

		$totalRegistros = 0;
		$stmt = $this->db->prepare($select2.$from.$where);	
		$stmt->execute();
		while( $reg = $stmt->fetch() )
			$totalRegistros = $reg['n'];
		$paginas = ceil($totalRegistros / $this->resultadosPagina);
		
		$inicio = (($paginaActual - 1 ) * $this->resultadosPagina ) ;
		$limit = "LIMIT ".$inicio.",".$this->resultadosPagina." ; " ;

		$stmt = $this->db->prepare($select1.$from.$where.$order.$limit);
		$stmt->execute();
		$respuesta = array(
			'paginas' => array(
				'totalResultados' => $totalRegistros,
				'totalPaginas'=> $paginas,
				'paginaActual' => $paginaActual
			),
			'configuracion' => array(
				'rutaImagenesCatalogo' => $this->configuracion->urlImagenesCatalogo ,
				'imagenNoDisponible' => $this->imagenSinInformacion ,
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
	function detalleMuestra(){
		
		$id = $_POST['id'] ;		
		$consulta = "SELECT 	m.numero_muetra, m.descripcion, m.formula_quimica, ctm.descripcion AS caracteristica_tipo_muestra, 
									tm.descripcion AS tipo_muestra, u.descripcion AS ubicacion,	r.descripcion AS region, p.descripcion AS pais,
									v.descripcion AS vitrina, c.descripcion AS coleccion, a.descripcion AS adquisicion
						FROM	muestras AS m
								INNER JOIN caracteristica_tipo_muestra AS ctm ON m.id_caracteristica_tipo_muestra = ctm.id_caractristica_tipo_muestra
								INNER JOIN tipo_muestra AS tm ON ctm.id_tipo_muestra = tm.id_tipo_muestra
								INNER JOIN ubicaciones AS u ON m.id_ubicacion = u.id_ubicacion
								INNER JOIN regiones AS r ON u.id_region = r.id_region AND u.id_region = r.id_region
								INNER JOIN paises AS p ON r.id_pais = p.id_pais
								INNER JOIN vitrinas AS v ON v.id_vitrina = m.id_vitrina
								INNER JOIN colecciones AS c ON c.id_coleccion = m.id_coleccion
								INNER JOIN adquisiciones AS a ON a.id_adquisiciones = m.id_adquicicion
						WHERE m.id = :id"; 
		$stmt = $this->db->prepare($consulta);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$muestra = null;
		while( $reg = $stmt->fetch() ){
			$muestra = array(
				'numeroMuestra' => $reg['numero_muetra'], 
				'descripcion' => $reg['descripcion'],
				'formula' => $reg['formula_quimica'],
				'caracteristicaTipoMuestra' => $reg['caracteristica_tipo_muestra'],
				'tipoMuestra' => $reg['tipo_muestra'],
				'ubicacion' => $reg['ubicacion'],
				'region' => $reg['region'],
				'pais' => $reg['pais'],
				'vitrina' => $reg['vitrina'],
				'coleccion' => $reg['coleccion'],
				'adquisicion' => $reg['adquisicion'],
			);
			if($reg['vitrina'] != $this->sinInfo)
				$muestra['imgVitrina'] = $this->configuracion->urlImagenesVitrinas. strtolower( str_replace(' ','_',$reg['vitrina'])).'.png' ;
			else
				$muestra['imgVitrina'] = '';
		}
		return $muestra;
	}
//--------------------------------------------------------------------------------------------------------

}

?>