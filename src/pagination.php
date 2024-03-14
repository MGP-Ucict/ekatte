<?php
//compute pages count and current page
require_once('./database/scripts/connection.php');
require_once('./src/fields.php');	
require_once('./src/functions.php');

$sql = "SELECT * FROM ekatte";
$rowsPerPage = 10;
$paramUrl = '?';
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $rowsPerPage;
if (!empty($_SERVER['QUERY_STRING'])) { //get query string
	$paramUrl = '?'. removeVar($_SERVER['QUERY_STRING'], 'page');
	$sql .= ' WHERE ';
	foreach ($fieldsArray as $key => $value) {
		if (!empty($_GET[$key])) {
			$sql .= $key . ' LIKE "%' . $_GET[$key] . '%" AND ';
		}	
	}
	$sql = substr($sql,0,-5);//remove last AND
}
$stmt = $connection->prepare($sql);
$stmt->execute();
$allDataArray = $stmt->fetchAll();
$countPages = ceil(count($allDataArray) / $rowsPerPage);
$prevPage = ($page > 1)? '<a href="'. $paramUrl. '&page='. $page - 1 .'"><< Предишна страница</a>' : '';
$nextPage = ($page < $countPages )? '<a href="'.$paramUrl.'&page='. $page + 1 .'">Следваща страница >></a>' : '';