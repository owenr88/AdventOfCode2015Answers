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


for ($second=1; $second <= $distance; $second++) { 

	foreach ($raindeer_data as $name => $stats) {

		if(!isset($flying[$name])) $flying[$name] = true;
		if(!isset($counter[$name])) $counter[$name] = 1;

		if($flying[$name]) {

			$progress[$name] += $stats['distance'];

			if($counter[$name] >= $stats['seconds']) {
				$flying[$name] = false;
				$counter[$name] = 0;
			}

		} elseif($counter[$name] >= $stats['rest']) {

			$flying[$name] = true;
			$counter[$name] = 0;

		}

		$counter[$name]++;

	}

	$in_lead = array_keys($progress, max($progress));
	foreach ($in_lead as $winner) {
		$points[$winner]++;
	}
	
}

var_dump( max($points) );
