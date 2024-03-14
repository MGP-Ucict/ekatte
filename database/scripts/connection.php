<?php

$connection = new PDO('mysql:teritorial_units', 'root', '', [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	]);
$stmt = $connection->prepare("USE teritorial_units");
$stmt->execute();