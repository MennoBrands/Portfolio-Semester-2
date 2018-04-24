<?php

//	$sqlHost = '';
//	$sqlUser = '';
//	$sqlPass = '';
//	$sqlDatabase = '';

	$sqlHost = '';
	$sqlUser = '';
	$sqlPass = '';
	$sqlDatabase = '';

	$conn = new PDO("mysql:host=$sqlHost;dbname=$sqlDatabase", $sqlUser, $sqlPass);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
