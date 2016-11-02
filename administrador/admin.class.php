<?php

class admin{
	
	function getMenu(){
		
		//TODO
		// Gestionar menu segun permisos de usuario
		
		$menu = array(
			new Menu('Perfil','perfil',false),
			new Menu('Usuarios','', array(
				new Menu('Nuevo Usuario','usuario',false),
				new Menu('Editar Usuario','listausuario',false)
			)),
			new Menu('Catalogo','', array(
				new Menu('Nueva Muestra','usuario',false),
				new Menu('Editar Muestra','listausuario',false)
			)),
			new Menu('Actividad Reciente','', array(
				new Menu('Nueva Actividad','usuario',false),
				new Menu('Editar Actividad','listausuario',false)
			)),
			new Menu('Recursos','', array(
				new Menu('Nuevo Recurso','usuario',false),
				new Menu('Editar Recurso','listausuario',false)
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