<?php

// http://adventofcode.com/day/14

$distance = 2503;
$input = file_get_contents('input.php');
$data = explode("\n", $input);

$raindeer_data = array();
$countown = array();

foreach ($data as $key => $row) {

	$re = "/([\\w]*) can fly ([\\d]+)[^0-9]*([\\d]+)[^0-9]*([\\d]*)/"; 
	preg_match($re, $row, $matches);
	$raindeer_data[ $matches[1] ] = array(
		'distance'	=> (int) $matches[2],
		'seconds'	=> (int) $matches[3],
		'rest'		=> (int) $matches[4],
	);
	$countown[ $matches[1] ] = array(
		'fly'	=> $matches[3],
		'rest'	=> 0
	);

}

foreach ($raindeer_data as $name => $stats) {

	$flying = true;
	$counter = 1;

	for ($second=1; $second <= $distance; $second++) { 

		if($flying) {

			$progress[$name] += $stats['distance'];

			if($counter >= $stats['seconds']) {
				$flying = false;
				$counter = 0;
			}

		} elseif($counter >= $stats['rest']) {

			$flying = true;
			$counter = 0;

		}

		$counter++;

	}
	
}

var_dump( max($progress) );