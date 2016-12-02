<?php

class index{
	
	function getMenu(){
		
		//TODO
		// Gestionar menu segun permisos de usuario
		/*
		$_SESSION['p_usuarios']
		$_SESSION['p_catalogo']
		$_SESSION['p_actividad']
		$_SESSION['p_recursos'] 
		*/
		$menu = array(
			new Menu('Perfil','perfil',false)
			//new Menu('Cerrar Sesi&oacute;n','cerrar', false)
		);

		if ($_SESSION['p_usuarios'] == 1)
		{
			array_push($menu, new Menu('Usuarios',null, array(			
				new Menu('Editar Usuario','listausuarios',false),
				new Menu('Nuevo Usuario','usuarios',false)
			)));
		}
		
		if($_SESSION['p_catalogo'] == 1)
		{
			array_push($menu,new Menu('Cat&aacute;logo',null, array(
				new Menu('Editar Muestra','listacatalogo',false),
				new Menu('Nueva Muestra','catalogo',false)
			)));
		}

		if($_SESSION['p_actividad'] == 1)
		{
			array_push($menu, new Menu('Actividad Reciente',null, array(
				new Menu('Editar Actividad','noticiaslista',false),
				new Menu('Nueva Actividad','noticias',false)
			)));
		}

		if($_SESSION['p_recursos'] == 1)
		{
			array_push($menu, new Menu('Recursos',null, array(
				new Menu('Editar Recurso','listarecursos',false),
				new Menu('Nuevo Recurso','recursos',false)
			)));
		}
		return $menu;
	}
}


class Menu{
	var $texto;
	var $modulo;
	var $submenu;	
	function __construct($texto,$modulo,$submenu){
		$this->texto = $texto;
		$this->modulo = $modulo;
		$this->submenu = $submenu;
	}
}

?>