<?php

// http://adventofcode.com/day/3

$input = file_get_contents('input.php');
$input = str_split($input);

$x = 0;
$y = 0;
$houses = array();

$houses['0.0'] = (int) 1;

foreach($input as $dir) {

	switch ($dir) {

		case '<':
			$x--;
			break;
		
		case '>':
			$x++;
			break;
		
		case '^':
			$y++;
			break;
		
		case 'v':
			$y--;
			break;

	}

	$houses[ (string) $x . '.' . (string) $y ]++;

}

var_dump( count($houses) );