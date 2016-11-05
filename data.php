<?php

	$usuario = 'root';
	$passwd = '';

	try {
		$conn = new PDO('mysql:host=localhost;dbname=Museo;charset=utf8', $usuario, $passwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		print "¡Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>