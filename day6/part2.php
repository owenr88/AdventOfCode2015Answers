<?php

// http://adventofcode.com/day/6

ini_set('memory_limit', '-1');


function doAction($words, $array) {

	list(, $action, $start_x, $start_y, $finish_x, $finish_y) = $words;

	for($x = $start_x; $x <= $finish_x; $x++) {

		for($y = $start_y; $y <= $finish_y; $y++) {

			switch ($action) {
				case 'on':
					$array[$x][$y]++;
					break;
				case 'off':
					if( $array[$x][$y] > 0 ) $array[$x][$y]--;
					break;
				case 'toggle':
					$array[$x][$y] = $array[$x][$y] + 2;
					break;
			}

		}

	}

	return $array;

}

function getCount($array) {

	$start = 0;
	$end = 1000;
	$count = 0;

	for($x = $start; $x <= $end; $x++) {

		if( empty($array[$x]) || !$array[$x] ) continue;

		$count += array_sum($array[$x]);

	}

	return $count;

}


$input = file_get_contents('input.php');
$array = explode("\n", $input);

$lights = array();

foreach($array as $line) {

	preg_match("/.*(on|off|toggle).(\d+)\,(\d+).through.(\d+)\,(\d+)/", $line, $words);

	unset($words[0]);

	$lights = doAction($words, $lights);

}

var_dump( getCount($lights) );
