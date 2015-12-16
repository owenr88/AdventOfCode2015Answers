<?php

// http://adventofcode.com/day/15

function getCookieScore($ingredient_amounts, $ingredients) {

	$cookie_score = array();

	foreach ($ingredients as $name => $props) {
		foreach ($props as $slug => $value) {
			$cookie_score[$slug] += ($value * $ingredient_amounts[$name]);
		}
	}

	$calories = $cookie_score['calories'];
	unset($cookie_score['calories']);

	$final_score = 1;

	foreach($cookie_score as $slug => $val) {
		$val = $val > 0 ? $val : 0;
		if( !isset($final_score) ) {
			$final_score = $val;
		} else {
			$final_score *= $val;
		}
	}

	return $calories === 500 ? $final_score : 0;

}

$input = file_get_contents('input.php');
$data = explode("\n", $input);

$ingredients = array();

foreach ($data as $key => $row) {

	$re = "/([\\w]*)\\:\\s[\\w]*\\s([\\-]?[\\d]*)\\,\\s[\\w]*\\s([\\-]?[\\d]*)\\,\\s[\\w]*\\s([\\-]?[\\d]*)\\,\\s[\\w]*\\s([\\-]?[\\d]*)\\,\\s[\\w]*\\s([\\-]?[\\d]*)/"; 
	preg_match($re, $row, $matches);

	$ingredients[ $matches[1] ] = array(
		'capacity'		=> (int) $matches[2],
		'durability'	=> (int) $matches[3],
		'flavor'		=> (int) $matches[4],
		'texture'		=> (int) $matches[5],
		'calories'		=> (int) $matches[6]
	);

}

$variations = pow(100, count($ingredients)-1);

$cookie_scores = array();

for ($i = 1; $i <= $variations; $i++) { 

	$cookie_data = array();
	$n = 1;
	$max = 100;
	$value = 0;

	foreach ($ingredients as $name => $props) {

		$max = $max - $value;
		$value = $n === count($ingredients) ? $max : rand(1, $max);
		if($value === 0) continue;
		$cookie_data[$name] = $value;

		$n++;

	}

	$names = http_build_query($cookie_data);

	$cookie_scores[$names] = getCookieScore($cookie_data, $ingredients);

}

var_dump( max($cookie_scores) );
