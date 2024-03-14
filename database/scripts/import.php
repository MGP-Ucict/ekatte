<?php
//import EKATTE data into database

require_once('../../src/fields.php');	
	
$connection = new PDO('mysql:', 'root', '', [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	]);	
	
//create database schema	
$sql = file_get_contents('../sql/schema.sql');
$connection->exec($sql);

//get data
$dataString =  file_get_contents('../data/ek_atte.json');
$dataArray = json_decode($dataString, true);

//save data into database
foreach($dataArray as $row) {
	$params = [];
	$insertQuery = 'INSERT INTO ekatte SET ';
	foreach($fieldsArray as $key => $value) {
		$insertQuery .= $key .' = :'.$key. ', ';
		$params[$key] = $row[$key];
	}
	//remove last comma
	$insertQuery = substr($insertQuery,0, -2);
	$stmt = $connection->prepare($insertQuery);

	$stmt->execute($params);
}
