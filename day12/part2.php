<?php

// http://adventofcode.com/day/12

function cycleForNumbers($array, $running_total, $is_parent_object) {

	$this_total = 0;

	foreach($array as $key => $val) {

		if( $val === 'red' && $is_parent_object ) {

			$this_total = 0;
			break;
			
		}

		if( is_int($val) ) {

			$prev_total = $running_total;
			$this_total += $val;

		} elseif( is_array($val) || is_object($val) ) {

			$this_total = cycleForNumbers($val, $this_total, is_object($val));

		}

	}

	$running_total += $this_total;

	return $running_total;

}

$input = file_get_contents('input.php');
$data = json_decode($input);

$running_total = cycleForNumbers($data, 0, true);

var_dump( $running_total );
