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
	var $urlImagenesBanner = 'img/banner/';
	var $urlImagenesVitrinas = 'img/vitrinas/';

//-- Archivos ----------------------------------
	var $tamanioMaximoArchivo = 8388608 ;
	
//-- Correo Electronico ----------------------------------
	var $correoHabilitado = false;
	var $mailSMTPHost = 'smtp.googlemail.com';  						
	var $mailUsername = '';            
	var $mailPassword = '';                        
	var $mailSMTPSecure = 'tls';                            
	var $mailPort = 25;                                   
}

?>
