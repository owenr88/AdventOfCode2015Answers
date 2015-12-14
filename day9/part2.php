<?php

// http://adventofcode.com/day/9

$input = file_get_contents('input.php');
$data = explode("\n", $input);

list($distances, $all_cities) = getDistances($data);
$all_totals = array();

function formatRow($row) {

	$re = "/([\\w]*) to ([\\w]*) = ([\\d]*)/"; 
	preg_match($re, $row, $matches);

	return $matches;

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

function getDistanceBetweenTwoCities($city_1, $city_2) {

    $data = $GLOBALS['distances'];

    if(!isset($data[$city_1]) || !isset($data[$city_2]) || $city_1 == $city_2) return (int) 0;

    $sum = (int) $data[$city_1][$city_2];

    return $sum;

}

function getValues($varieties) {

    $final = array();

    foreach ($varieties as $key => $string) {

        $array = explode(" ", $string);

        $total = 0;

        for($r = 0; $r <= count($array)-1; $r++) {

            if(!isset($array[$r+1])) continue;

            $total += getDistanceBetweenTwoCities($array[$r], $array[$r+1]);

        }

        $final[$string] = $total;

    }

    return $final;

}

function pc_permute($left_to_visit, $visited_cities = array( ), $last_city = false) {

    if (empty($left_to_visit)) { 

    	$GLOBALS['all_paths'][] = join(' ', $visited_cities);

    }  else {

        for ($i = count($left_to_visit) - 1; $i >= 0; --$i) {

            $new_left_to_visit = $left_to_visit;
            $new_visited_cities = $visited_cities;
            list($this_city) = array_splice($new_left_to_visit, $i, 1);
            array_unshift($new_visited_cities, $this_city);
            pc_permute($new_left_to_visit, $new_visited_cities, $this_city);

        }

    }

}

pc_permute($all_cities, array());

$all_paths = getValues($GLOBALS['all_paths']);

var_dump( max($all_paths) ); 
