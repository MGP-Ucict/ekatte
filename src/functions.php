<?php
//remove parameter page from guery string to avoid multiple page parameters
function removeVar($path, $key) {
	$paramArray = explode('&', $path);
	foreach ($paramArray as $key => $val) {
		$valArray = explode('=', $val);
		if ($valArray[0] === 'page') {
			unset($paramArray[$key]);
		}
	}
	
	$path = !empty($paramArray) ? implode('&', $paramArray) : '';
	return $path;
}