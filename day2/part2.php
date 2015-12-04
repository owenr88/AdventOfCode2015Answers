<?php

// http://adventofcode.com/day/2

function getRibbonDimension($l = 0, $w = 0, $h = 0) {

	if(!$l || !$w || !$h) var_dump('missin!');

	$sides = array($l, $w, $h);
	asort($sides, SORT_NUMERIC);
	$shortest = array_slice($sides, 0, 2);

	$ribbon = $shortest[0] + $shortest[1] + $shortest[0] + $shortest[1];

	$bow = $l * $w * $h;

	return ($ribbon + $bow);

}

$input = file_get_contents('input.php');
$array = explode("\n", $input);

$final_ribbon = 0;

foreach($array as $row) {

	$sizes = explode("x", $row);

	$final_ribbon += getRibbonDimension($sizes[0], $sizes[1], $sizes[2]);

}

var_dump($final_ribbon);