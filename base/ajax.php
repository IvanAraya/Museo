<?php
	session_start() ;
	
	$script = $_POST['0'] ;
	$clase = $_POST['1'] ;	
	$metodo = $_POST['2'] ;
	
	if( !is_Null($script) && !is_Null($clase) && !is_Null($metodo) ){
		if($script=='')
			$script = $clase.'.class.php';
		include('../'.$script) ;
		if(!class_exists($clase)){
			echo "<span>No existe la clase '".$clase."'.</span>" ;
			exit() ;
		}
		try{
			$clase =  new $clase() ;
			$resp = $clase->$metodo() ;
			echo json_encode($resp) ;
		}catch(Exception $err){
			echo '<span>'.$err->getMessage().'</span>' ;
		}
	}else{
		echo '<span>Parametros no validos</span>';
	}
	
?>