<?php

class index{
	
	function getMenu(){
		
		//TODO
		// Gestionar menu segun permisos de usuario
		
		$menu = array(
			new Menu('Perfil','perfil',false),
			new Menu('Usuarios',null, array(
				new Menu('Nuevo Usuario','usuarios',false),
				new Menu('Editar Usuario','listausuarios',false)
			)),
			new Menu('Catalogo',null, array(
				new Menu('Nueva Muestra','catalogo',false),
				new Menu('Editar Muestra','listacatalogo',false)
			)),
			new Menu('Actividad Reciente',null, array(
				new Menu('Nueva Actividad','noticias',false),
				new Menu('Editar Actividad','listanoticias',false)
			)),
			new Menu('Recursos',null, array(
				new Menu('Nuevo Recurso','recursos',false),
				new Menu('Editar Recurso','listarecursos',false)
			)),
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