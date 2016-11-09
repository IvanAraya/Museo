<?php
	$usuario = 'root';
	$passwd = '';
	$host = 'localhost' ;
	$db = 'museo' ;
	

	try {
		$conn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $usuario, $passwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		if($_SESSION['debug'])
			print $e->getMessage();
		else
			die();
	}
?>