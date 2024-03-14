<?php
//connect to database
$connection = new PDO('mysql:teritorial_units', 'root', '', [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	]);
//select database 
$stmt = $connection->prepare("USE teritorial_units");
$stmt->execute();