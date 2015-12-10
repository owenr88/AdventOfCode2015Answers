<?php

// http://adventofcode.com/day/9

ini_set('memory_limit', '-1');

function formatRow($row) {

	$re = "/([\\w]*) to ([\\w]*) = ([\\d]*)/"; 
	preg_match($re, $row, $matches);

	return $matches;

}

function removeCity($city, $array) {

	if(empty($array) || !in_array($city, $array)) return $array;

	$key = array_search($city, $array);

	unset( $array[$key] );

	return $array;

}

function getDistances($data) {

	$final = array();

	$shortest = array();

	$cities = array();

	foreach($data as $row) {

		list(, $city1, $city2, $distance) = formatRow($row);

		if( !isset($final[$city1]) ) $final[$city1] = array();
		if( !$final[$city1][$city2] ) $final[$city1][$city2] = (int) $distance;

		if( !isset($final[$city2]) ) $final[$city2] = array();
		if( !$final[$city2][$city1] ) $final[$city2][$city1] = (int) $distance;

		if( !in_array($city1, $cities) ) $cities[] = $city1;
		if( !in_array($city2, $cities) ) $cities[] = $city2;

	}

	return array($final, $cities);

}

function getShortestPathFrom($city1, $distances, $left_to_visit, $total_distance, $level) {

	$final = array();

	$level++;

	foreach ($distances as $city2 => $data) {

		if( $city1 === $city2 ) continue;

		if( empty($left_to_visit) ) {

			$GLOBALS['all_distances'][] = $total_distance;

			return $total_distance;

		}

		if( !in_array($city2, $left_to_visit) ) continue;

		$total_distance += $distances[$city1][$city2];

		//var_dump(str_repeat(" ", $level-1) . "Level $level - Checking $city1 to $city2 (Distance so far: ". $total_distance ." and this distance: ".$distances[$city1][$city2].")");

		$left_to_visit = removeCity($city2, $left_to_visit);

		$final[$city2] = getShortestPathFrom($city2, $distances, $left_to_visit, $total_distance, $level);

		$left_to_visit[] = $city2;

		$total_distance = 0;
		
	}

	return $final;

}

function getPathsString($array, $key) {
	echo "$key > ";
	if( is_array($array) ) {
		array_walk($array, 'getPathsString');
	} else {
		echo $array . "\r\n";
	}
}

function getValuesArray($array) {
	if( is_array($array) ) {
		array_map('getValuesArray',$array);
	} else {
		return $array;
	}
}

$input = file_get_contents('input.php');
//$input = file_get_contents('test.php');
$data = explode("\n", $input);

list($distances, $all_cities) = getDistances($data);


var_dump($distances);

$final = array();

foreach($distances as $city1 => $data) {

	$left_to_visit = removeCity($city1, $all_cities);

	$final[$city1] = getShortestPathFrom($city1, $distances, $left_to_visit, 0, 1);

}

//array_walk($final, 'getPathsString');

//var_dump(min($GLOBALS['all_distances']));

//var_dump($final, min($GLOBALS['all_distances']));
