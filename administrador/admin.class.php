<?php

class admin{
	
	function getMenu(){
		
		//TODO
		// Gestionar menu segun permisos de usuario
		
		$menu = ['usuarios','catalogo','recursos','actividad reciente'];
		return $menu;
		
	}
}

?>