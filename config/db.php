<?php 
	$dsn = "mysql:host=localhost;dbname=vjstore";

	try {
		$pdo = new PDO($dsn, 'root', '');
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>