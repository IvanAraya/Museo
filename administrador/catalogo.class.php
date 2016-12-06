<?php 

include('../../configuracion.php');
include('../../data.php');

class catalogo{
	
	var $db;
	var $configuracion ;
	var $sinInfo = 'Sin Información' ;
	var $imagenSinInformacion = 'nodisponible.png' ;
	var $sinNumero = 'S/N' ;
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
				'rutaImagenesCatalogo' => '../'.$this->configuracion->urlImagenesCatalogo ,
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
		$this->db = null;
		return $respuesta;
	}
//--------------------------------------------------------------------------------------------------------
	function guardar(){
		
		$id = $_POST['idMuestra'] ;
		if($id == "")
			return $this->nuevaMuestra();
		else
			return $this->actualizarMuestra();		
	}
//--------------------------------------------------------------------------------------------------------
	function nuevaMuestra(){
		
		$respuesta = array(
			'resultado' => true ,
			'mensaje' => null
		);
		
		$consulta = "SELECT MAX(id) FROM muestras";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute();
		if($row = $stmt->fetch())
			$nmax = trim($row[0]);
		$id = $nmax+1;
		$numMuestra = addslashes($_POST['txtNmuestra']) ;
		$descripcion = addslashes($_POST['txtDescripcion']) ;
		$formula = addslashes($_POST['formula']) ;
		$caracTipoMuestra = $_POST['cmbCarTipoMuestra'] ;
		$ubicacion = $_POST['cmbUbicacion'] ;
		$coleccion = $_POST['cmbColecciones'] ;
		$adquisicion = $_POST['cmbAdquisicion'] ;
		$vitrinas = $_POST['cmbVitrinas'] ;
		
		if($numMuestra == '')
			$numMuestra = $this->sinNumero ;
		if(trim($formula) == '<br>')
			$formula = $this->sinInfo ;

		try{
			$consulta = 'INSERT INTO muestras 
								(id, numero_muetra, descripcion, formula_quimica, id_caracteristica_tipo_muestra, id_ubicacion, id_coleccion, id_vitrina, id_adquicicion, ruta_imagen ) 
							VALUES 
								(:id, :numMuestra, :descripcion, :formula, :caracteristica, :ubicacion, :coleccion,	:vitrina , :adquisicion, :imagen )';
			$stmt = $this->db->prepare($consulta);	
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':numMuestra',$numMuestra);
			$stmt->bindParam(':descripcion',$descripcion);
			$stmt->bindParam(':formula',$formula);
			$stmt->bindParam(':caracteristica',$caracTipoMuestra);
			$stmt->bindParam(':ubicacion',$ubicacion);
			$stmt->bindParam(':coleccion',$coleccion);
			$stmt->bindParam(':vitrina',$vitrinas);
			$stmt->bindParam(':adquisicion',$adquisicion);
			$stmt->bindParam(':imagen',$this->sinInfo);
			$stmt->execute();
		}catch(Exception $e){
			$respuesta['resultado'] = false;
			if($this->configuracion->debug)
				$respuesta['mensaje'] = $e->getMessage();
			else
				$respuesta['mensaje'] = 'Ocurrió un error al guardar los datos. ';
			$this->db = null;
			return $respuesta;
		}
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$check = getimagesize($_FILES['foto']['tmp_name']);
			if($check){
				if($_FILES['foto']['size'] > $this->configuracion->tamanioMaximoArchivo){
					$respuesta['resultado'] = false;
					$respuesta['mensaje'] = 'El tamaño del archivo supera el maximo permitido.';
					$this->db = null;
					return $respuesta;
				}
				
				$nombreArchivoNuevo = str_replace(' ','_',$_FILES['foto']['name']);
				$imagen_tmp = $_FILES['foto']['tmp_name'];
				$ruta_imagen = $this->configuracion->urlImagenesCatalogo.$nombreArchivoNuevo ;
				$ruta_guardado = $this->configuracion->rutaAplicacion.$ruta_imagen;
				$subida = move_uploaded_file($imagen_tmp, $ruta_guardado);	
				if(!$subida){
					$respuesta['resultado'] = false;
					$respuesta['mensaje'] = 'El archivo no pudo ser guardado, intentelo nuevamente. Si el problema persiste contacte al administrador de sistema.';
					$this->db = null;
					return $respuesta;
				}
			}
			
			try{
				$consulta = 'UPDATE muestras SET ruta_imagen = :imagen WHERE id = :id';
				$stmt = $this->db->prepare($consulta);	
				$stmt->bindParam(':id',$id);
				$stmt->bindParam(':imagen',$nombreArchivoNuevo);
				$stmt->execute();
			}catch(Exception $e){
				$respuesta['resultado'] = false;
				if($this->configuracion->debug)
					$respuesta['mensaje'] = $e->getMessage();
				else
					$respuesta['mensaje'] = 'Ocurrió un error al guardar la imagen.';
				$this->db = null;
				return $respuesta;
			}
		}
		$this->db = null;
		return $respuesta;
		
	}
//--------------------------------------------------------------------------------------------------------
	function actualizarMuestra(){
		
		$respuesta = array(
			'resultado' => true ,
			'mensaje' => null
		);
		
		$id = $_POST['idMuestra'] ;
		$numMuestra = addslashes($_POST['txtNmuestra']) ;
		$descripcion = addslashes($_POST['txtDescripcion']) ;
		$formula = addslashes($_POST['formula']) ;
		$caracTipoMuestra = $_POST['cmbCarTipoMuestra'] ;
		$ubicacion = $_POST['cmbUbicacion'] ;
		$coleccion = $_POST['cmbColecciones'] ;
		$adquisicion = $_POST['cmbAdquisicion'] ;
		$vitrinas = $_POST['cmbVitrinas'] ;
		
		if($numMuestra == '')
			$numMuestra = $this->sinNumero ;
		if(trim($formula) == '<br>')
			$formula = $this->sinInfo ;

		try{
			$consulta = 'UPDATE muestras SET numero_muetra = :numMuestra, descripcion = :descripcion, formula_quimica = :formula,
								id_caracteristica_tipo_muestra = :caracteristica, id_ubicacion = :ubicacion, id_coleccion = :coleccion,
								id_vitrina = :vitrina , id_adquicicion = :adquisicion 
							WHERE id = :id';
			$stmt = $this->db->prepare($consulta);	
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':numMuestra',$numMuestra);
			$stmt->bindParam(':descripcion',$descripcion);
			$stmt->bindParam(':formula',$formula);
			$stmt->bindParam(':caracteristica',$caracTipoMuestra);
			$stmt->bindParam(':ubicacion',$ubicacion);
			$stmt->bindParam(':coleccion',$coleccion);
			$stmt->bindParam(':vitrina',$vitrinas);
			$stmt->bindParam(':adquisicion',$adquisicion);
			$stmt->execute();
		}catch(Exception $e){
			$respuesta['resultado'] = false;
			if($this->configuracion->debug)
				$respuesta['mensaje'] = $e->getMessage();
			else
				$respuesta['mensaje'] = 'Ocurrió un error al guardar los datos. ';
			$this->db = null;
			return $respuesta;
		}
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$check = getimagesize($_FILES['foto']['tmp_name']);
			if($check){
				if($_FILES['foto']['size'] > $this->configuracion->tamanioMaximoArchivo){
					$respuesta['resultado'] = false;
					$respuesta['mensaje'] = 'El tamaño del archivo supera el maximo permitido.';
					$this->db = null;
					return $respuesta;
				}
				
				$stmt = $this->db->prepare('SELECT ruta_imagen FROM muestras WHERE id = :id');
				$stmt->bindParam(':id',$id);			
				$stmt->execute();
				while( $reg = $stmt->fetch() )
					$rutaImagenActual = $reg['ruta_imagen'];	
				if($rutaImagenActual != $this->sinInfo)
					unlink($this->configuracion->rutaAplicacion.$this->configuracion->urlImagenesCatalogo.$rutaImagenActual);
				
				$nombreArchivoNuevo = str_replace(' ','_',$_FILES['foto']['name']);
				$imagen_tmp = $_FILES['foto']['tmp_name'];
				$ruta_imagen = $this->configuracion->urlImagenesCatalogo.$nombreArchivoNuevo ;
				$ruta_guardado = $this->configuracion->rutaAplicacion.$ruta_imagen;
				$subida = move_uploaded_file($imagen_tmp, $ruta_guardado);	
				if(!$subida){
					$respuesta['resultado'] = false;
					$respuesta['mensaje'] = 'El archivo no pudo ser guardado, intentelo nuevamente. Si el problema persiste contacte al administrador de sistema.';
					$this->db = null;
					return $respuesta;
				}
			}
			
			try{
				$consulta = 'UPDATE muestras SET ruta_imagen = :imagen WHERE id = :id';
				$stmt = $this->db->prepare($consulta);	
				$stmt->bindParam(':id',$id);
				$stmt->bindParam(':imagen',$nombreArchivoNuevo);
				$stmt->execute();
			}catch(Exception $e){
				$respuesta['resultado'] = false;
				if($this->configuracion->debug)
					$respuesta['mensaje'] = $e->getMessage();
				else
					$respuesta['mensaje'] = 'Ocurrió un error al guardar la imagen.';
				$this->db = null;
				return $respuesta;
			}
		}
		$this->db = null;
		return $respuesta;
		
	}
//--------------------------------------------------------------------------------------------------------
	function eliminarMuestra(){
		
		$respuesta = array(
			'resultado' => true ,
			'mensaje' => null
		);
		
		$id = $_POST['idMuestra'] ;
		
		try{			
			$stmt = $this->db->prepare('SELECT ruta_imagen FROM muestras WHERE id = :id');
			$stmt->bindParam(':id',$id);			
			$stmt->execute();
			while( $reg = $stmt->fetch() )
				$rutaImagenActual = $reg['ruta_imagen'];	
			if($rutaImagenActual != $this->sinInfo)
				unlink($this->configuracion->rutaAplicacion.$this->configuracion->urlImagenesCatalogo.$rutaImagenActual);
			
			$consulta = 'DELETE FROM muestras WHERE id = :id' ;
			$stmt = $this->db->prepare($consulta);	
			$stmt->bindParam(':id',$id);
			$stmt->execute();
		
		}catch(Exception $e){
			$respuesta['resultado'] = false;
			if($this->configuracion->debug)
				$respuesta['mensaje'] = $e->getMessage();
			else
				$respuesta['mensaje'] = 'Ocurrió un error al guardar la imagen.';
			$this->db = null;
			return $respuesta;
		}
		
		
		$this->db = null;
		return $respuesta ;
	}
//--------------------------------------------------------------------------------------------------------
	function llenarCombos(){
		
		$combos = array();	
		$combos['vitrinas'] = $this->obtenerDetalleTabla('vitrinas','descripcion','id_vitrina','descripcion');
		$combos['colecciones'] = $this->obtenerDetalleTabla('colecciones','descripcion','id_coleccion','descripcion');
		$combos['paises'] = $this->obtenerDetalleTabla('paises','descripcion','id_pais','descripcion');
		
		if(isset($_POST['editar']))
			$combos['tipoMuestra'] = $this->obtenerDetalleTabla('tipo_muestra','descripcion','id_tipo_muestra','descripcion');{
			$combos['adquisicion'] = $this->obtenerDetalleTabla('adquisiciones','descripcion','id_adquisiciones','descripcion');
		}
		return $combos ;
	}
//--------------------------------------------------------------------------------------------------------
	function llenarCaracteristica(){

		$id = $_POST['id'];
		$salida = array(
			'caracteristicas' => $this->obtenerDetalleTabla('caracteristica_tipo_muestra','descripcion','id_caractristica_tipo_muestra','descripcion','id_tipo_muestra',$id)
		);
		if(isset($_POST['seleccion']))
			$salida['seleccion'] = $_POST['seleccion'];
		else
			$salida['seleccion'] = false;
		return $salida ;
	}
//--------------------------------------------------------------------------------------------------------
	function llenarRegion(){
		$id = $_POST['id'];
		$salida = array(
			'regiones' => $this->obtenerDetalleTabla('regiones','descripcion','id_region','descripcion','id_pais',$id)
		);
		if(isset($_POST['region'])){
			$salida['region'] = $_POST['region'];
			$salida['ubicacion'] = $_POST['ubicacion'];
		}else
			$salida['region'] = false;
		return $salida;
	}
//--------------------------------------------------------------------------------------------------------
	function llenarUbicacion(){
		$id = $_POST['id'];
		$salida = array(
			'ubicaciones' => $this->obtenerDetalleTabla('ubicaciones','descripcion','id_ubicacion','descripcion','id_region',$id)
		);
		if(isset($_POST['seleccion']))
			$salida['seleccion'] = $_POST['seleccion'];
		else
			$salida['seleccion'] = false;		
		return $salida;
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
		$consulta = "SELECT 	m.numero_muetra, m.descripcion, m.formula_quimica, 
									ctm.descripcion AS caracteristica_tipo_muestra, 
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
				'adquisicion' => $reg['adquisicion']
			);
			if($reg['vitrina'] != $this->sinInfo)
				$muestra['imgVitrina'] = '../'.$this->configuracion->urlImagenesVitrinas. strtolower( str_replace(' ','_',$reg['vitrina'])).'.png' ;
			else
				$muestra['imgVitrina'] = '';
		}
		$this->db = null;
		return $muestra;
	}
//--------------------------------------------------------------------------------------------------------
	function detalleMuestraEditor(){
		
		$id = $_POST['id'] ;		
		$consulta = "SELECT
							m.numero_muetra, m.descripcion, m.formula_quimica,	m.id_caracteristica_tipo_muestra,
							ctm.id_tipo_muestra, m.id_ubicacion, u.id_region, r.id_pais, m.id_coleccion, 
							m.id_vitrina, m.id_adquicicion, m.ruta_imagen
						FROM
							muestras AS m
							INNER JOIN caracteristica_tipo_muestra AS ctm ON m.id_caracteristica_tipo_muestra = ctm.id_caractristica_tipo_muestra
							INNER JOIN ubicaciones AS u ON m.id_ubicacion = u.id_ubicacion
							INNER JOIN regiones AS r ON u.id_region = r.id_region 
						WHERE m.id = :id"; 
		$stmt = $this->db->prepare($consulta);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$muestra = null;
		while( $reg = $stmt->fetch() ){
			$muestra = array(
				'idMuestra' => $id ,
				'numeroMuestra' => $reg['numero_muetra'], 
				'descripcion' => $reg['descripcion'],
				'formula' => $reg['formula_quimica'],
				'caracteristicaTipoMuestra' => $reg['id_caracteristica_tipo_muestra'],
				'tipoMuestra' => $reg['id_tipo_muestra'],
				'ubicacion' => $reg['id_ubicacion'],
				'region' => $reg['id_region'],
				'pais' => $reg['id_pais'],
				'vitrina' => $reg['id_vitrina'],
				'coleccion' => $reg['id_coleccion'],
				'adquisicion' => $reg['id_adquicicion']
			);
			if($reg['ruta_imagen'] != $this->sinInfo)
				$muestra['imagen'] = '../'.$this->configuracion->urlImagenesCatalogo.$reg['ruta_imagen'] ;
			else
				$muestra['imagen'] = '../'.$this->configuracion->urlImagenesCatalogo.$this->imagenSinInformacion ;
		}
		$this->db = null;
		return $muestra;
	}
//--------------------------------------------------------------------------------------------------------
}

?>