<?php
	session_start() ;
	$clase = $_POST['className'] ;
	$script = $_POST['script'] ;
	$metodo = $_POST['method'] ;	
	if( !is_Null($script) && !is_Null($clase) && !is_Null($metodo) ){
		include('../'.$script) ;
		$clase = explode('.',$clase);
		$clase = $clase[0];
		if(!class_exists($clase)){
			echo "<span>No existe la clase '".$clase."'.</span>" ;
			exit() ;
		}
		try{
			$clase =  new $clase() ;
			$resp = $clase->$metodo() ;
			echo json_encode($resp) ;
		}catch(Exception $err){
			echo '<span>'.$err->getMessage.'</span>' ;
		}
	}else{
		echo '<span>Parametros no validos</span>';
	}
	
?>