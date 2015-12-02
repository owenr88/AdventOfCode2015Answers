<?php


function getPaperDimension($l = 1, $w = 1, $h = 1) {

	$total_length = ($l * $w); 
	$total_width = ($w * $h);
	$total_height = ($h * $l);
	$additional = min(array($total_length, $total_width, $total_height)); // Add smallest side
	return ($total_length * 2) + ($total_width * 2) + ($total_height * 2) + $additional;

}

function getRibbonDimension($l = 0, $w = 0, $h = 0) {

	if(!$l || !$w || !$h) var_dump('missin!');

	$sides = array($l, $w, $h);
	asort($sides, SORT_NUMERIC);
	$shortest = array_slice($sides, 0, 2);

	$ribbon = $shortest[0] + $shortest[1] + $shortest[0] + $shortest[1];

	$bow = $l * $w * $h;

	return ($ribbon + $bow);

}


echo getRibbonDimension(2, 3, 4) . "\n";
echo getRibbonDimension(1, 1, 10) . "\n";


$input = file_get_contents('input.php');
$array = explode("\n", $input);

$final_paper = 0;
$final_ribbon = 0;

foreach($array as $row) {

	$sizes = explode("x", $row);

	$final_paper += getPaperDimension($sizes[0], $sizes[1], $sizes[2]);

	$final_ribbon += getRibbonDimension($sizes[0], $sizes[1], $sizes[2]);

}

var_dump('paper = ' . $final_paper);
var_dump(' and ribbon = ' . $final_ribbon);

?>