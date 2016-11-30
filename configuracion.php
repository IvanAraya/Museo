<?php 

class Configuracion{
	
//-- Desarrollo ------------------------------------------
	var $debug = true;
	
//-- Base de Datos ---------------------------------------
	var $dbUser = 'root';
	var $dbPassword = '';
	var $dbHost = 'localhost' ;
	var $dbName = 'museo' ;

//-- Rutas de Archivos -----------------------------------
	var $rutaAplicacion = 'C:/xampp/htdocs/museo/';
	var $urlRecursos = 'recursos/' ;
	var $urlImagenesNoticias = 'img/imgnoticias/';
	var $urlImagenesCatalogo = 'img/catalogo/';

//-- Archivos ----------------------------------
	var $tamanioMaximoArchivo = 8 ;
	
//-- Correo Electronico ----------------------------------
	var $correoHabilitado = true;
	var $mailSMTPHost = 'smtp.googlemail.com';  						
	var $mailUsername = 'iaraya1@alumnosuls.cl';            
	var $mailPassword = 'dassault1';                        
	var $mailSMTPSecure = 'tls';                            
	var $mailPort = 25;                                   
}

?>
