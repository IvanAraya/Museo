<?php

class index{
	
	function getMenu(){
		
		//TODO
		// Gestionar menu segun permisos de usuario
		
		$menu = array(
			new Menu('Perfil','perfil',false),
			new Menu('Usuarios',null, array(			
				new Menu('Editar Usuario','listausuarios',false),
				new Menu('Nuevo Usuario','usuarios',false)
			)),
			new Menu('Cat&aacute;logo',null, array(
				new Menu('Editar Muestra','listacatalogo',false),
				new Menu('Nueva Muestra','catalogo',false)
			)),
			new Menu('Actividad Reciente',null, array(
				new Menu('Editar Actividad','noticiaslista',false),
				new Menu('Nueva Actividad','noticias',false)
			)),
			new Menu('Recursos',null, array(
				new Menu('Editar Recurso','listarecursos',false),
				new Menu('Nuevo Recurso','recursos',false)
			))
		);

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