<?php
require_once('./database/scripts/connection.php');
require_once('./src/fields.php');
require_once('./src/pagination.php');	
//search filters and pagination (query)
$sql = "SELECT * FROM ekatte";
if (!empty($_SERVER['QUERY_STRING'])) { //get query string
	$sql .= ' WHERE ';
	foreach ($fieldsArray as $key => $value) {
		if (!empty($_GET[$key])) {
			$sql .= $key . ' LIKE "%' . $_GET[$key] . '%" AND ';
		}	
	}
	$sql = substr($sql,0,-5);//remove last AND
}

$sql .= ' LIMIT :offset, :perPage';

$params = [
	'offset' => $offset,
	'perPage' => $rowsPerPage
];
$stmt = $connection->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':perPage', $rowsPerPage, PDO::PARAM_INT);
$stmt->execute();
$dataArray = $stmt->fetchAll();

//search fields (form)
$formHtml = "<form action='".$_SERVER['PHP_SELF']."'><table><tr>";
foreach ($fieldsArray as $key => $value) {
	$formHtml .= (in_array($key, ['obshtina', 'category'])) ? '</tr><tr>' : '';
	$formHtml .= '<td>'
	. '<label>' . $value . '</label><br>'
	. '<input type="text" name="'. $key.'">'
	. '</td>';
}
$formHtml .= '</tr></table>';
$formHtml .= '<input type="submit" value="Търси">&nbsp;';
$formHtml .= '<a href="index.php">Изчисти филтрите</a>';
$formHtml .= '</form><br><br>';
echo $formHtml;

//show results into table
$html = '<table><tr>';
foreach ($fieldsArray as $key => $value) {
	$html .= '<th>'. $value . '</th>';
}
$html .=  '</tr>';
		
foreach($dataArray as $row) {
	$html .= '<tr>';
	foreach ($fieldsArray as $key => $value) {
		$html .= '<td align="center">'. $row[$key] . '</td>';
	}
	$html .= '</tr>';
}
$html .= '</table>';
//show pagination links
$html .= $prevPage . '&nbsp;' .$nextPage;
echo $html;