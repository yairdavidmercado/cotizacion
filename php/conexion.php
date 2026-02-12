<?php
	
	$dbname = $_SESSION['dbname'];
	define ('DB_HOST','host.docker.internal'); //Host de postgresql (puede ser otro)
	define ('DB_USER','root'); //Usuario de postgresql (puede ser otro)
	define ('DB_PASS','root'); //Password de postgresql (puede ser otro)
	define ('DB_NAME', $dbname); //Database de postgresql (puede ser otra)
	define ('DB_PORT','3306'); //Puerto de postgresql (puede ser otro)
	define ('DB_NAME_GLOBAL','coticlic_company');
?>