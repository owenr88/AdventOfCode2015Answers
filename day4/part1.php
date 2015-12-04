<?php

// http://adventofcode.com/day/4

function getFirstFiveZeros($input) {

	$max = 1000000;

	for($h = 0; $h <= $max; $h++) {

		$md5 = md5($input . $h);

		$first_five = substr($md5, 0, 5);

		if($first_five === '00000') break;

	}

	if( $h >= $max ) return false;

	return $h;

}

$input = 'bgvyzdsv';

var_dump( getFirstFiveZeros($input) );