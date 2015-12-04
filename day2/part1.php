<?php

// http://adventofcode.com/day/2

function getPaperDimension($l = 1, $w = 1, $h = 1) {

	$total_length = ($l * $w); 
	$total_width = ($w * $h);
	$total_height = ($h * $l);
	$additional = min(array($total_length, $total_width, $total_height)); // Add smallest side
	return ($total_length * 2) + ($total_width * 2) + ($total_height * 2) + $additional;

}

$input = file_get_contents('input.php');
$array = explode("\n", $input);

$final_paper = 0;

foreach($array as $row) {

	$sizes = explode("x", $row);

	$final_paper += getPaperDimension($sizes[0], $sizes[1], $sizes[2]);

}

var_dump($final_paper);