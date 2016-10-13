<?php

	$usuario = 'www';
	$passwd = '12345';

	try {
		$conn = new PDO('mysql:host=localhost;dbname=catalogo;charset=utf8', $usuario, $passwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		print "¡Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>