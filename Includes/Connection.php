<?php

//	$sqlHost = 'studmysql01.fhict.local';
//	$sqlUser = 'dbi361931';
//	$sqlPass = 'Rataplan12';
//	$sqlDatabase = 'dbi361931';

	$sqlHost = 'localhost';
	$sqlUser = 'root';
	$sqlPass = '';
	$sqlDatabase = 'portfolio';

	$conn = new PDO("mysql:host=$sqlHost;dbname=$sqlDatabase", $sqlUser, $sqlPass);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
