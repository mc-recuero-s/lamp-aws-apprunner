<?php
	ini_set('display_errors', 1);
	/* Parámetros de la BD
	$host = "localhost";
	$user = "smartcity";
	$contra = "Z7fjz0&9";
	$base = "sham_smartcity";*/

	$host = "localhost";
	$user = "root";
	$contra = "";
	$base = "saciar";

	// Conexión a la BD
	$conexion = mysqli_connect($host,$user,$contra,$base);
	if (!$conexion) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}
	mysqli_set_charset( $conexion, 'utf8');
		
?>
