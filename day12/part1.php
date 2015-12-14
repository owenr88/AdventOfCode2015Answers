<?php

// http://adventofcode.com/day/12

function cycleForNumbers($array, $running_total) {

	foreach($array as $key => $val) {

		if( is_int($val) ) {

			$running_total += $val;

		} elseif( is_array($val) || is_object($val) ) {

			$running_total = cycleForNumbers($val, $running_total);

		}

	}

	return $running_total;

}

$input = file_get_contents('input.php');
$data = json_decode($input);

$running_total = cycleForNumbers($data, 0);

var_dump( $running_total );
