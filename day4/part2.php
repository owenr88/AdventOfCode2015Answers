<?php

// http://adventofcode.com/day/4

function getFirstSixZeros($input) {

	$max = 10000000;

	for($h = 0; $h <= $max; $h++) {

		$md5 = md5($input . $h);

		$first_six = substr($md5, 0, 6);

		if($first_six === '000000') break;

	}

	if( $h >= $max ) return false;

	return $h;

}

$input = 'bgvyzdsv';

var_dump( getFirstSixZeros($input)) ;