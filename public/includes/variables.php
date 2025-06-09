<?php
	$_SESSION['idSitio'] = 3;
	$_SESSION['nombreSitio'] = "Municipio de Sabaneta";

	$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	$url = $_SERVER['REQUEST_URI'];
	$url = explode("/",$_SERVER['REQUEST_URI']);
	if(!empty($url[1])){ $subUrlReal = $url[1]; }
	if(!empty($url[2])){ $itemUrlReal = $url[2]; }

	seo();
	sitio();
?>