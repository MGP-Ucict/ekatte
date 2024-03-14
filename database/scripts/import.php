<?php
require_once('connection.php');
require_once('../../src/fields.php');	
	
$sql = file_get_contents('../sql/schema.sql');
$connection->exec($sql);
$dataString =  file_get_contents('../data/ek_atte.json');
$dataArray = json_decode($dataString, true);
$insertQuery = 'INSERT INTO ekatte SET ';
$params = [];
foreach($dataArray as $row) {
	foreach($fieldsArray as $key => $value) {
		$insertQuery .= $key .'= :$key,';
		$params[$key] = $row[$key];
	}
	//remove last comma
	$insertQuery = substr($insertQuery,0,-2);
	$stmt = $connection->prepare($insertQuery);

	$stmt->execute($params);
}
