<?php

// http://adventofcode.com/day/3

$input = file_get_contents('input.php');
$input = str_split($input);

$santa_x = 0;
$santa_y = 0;
$robosanta_x = 0;
$robosanta_y = 0;

$houses = array();

$houses['0.0'] = (int) 2;

$h = 1;

foreach($input as $dir) {

	$santa = ($h % 2 == 0 ? 'santa' : 'robosanta');

	switch ($dir) {

		case '<':
			(int) ${$santa.'_x'}--;
			break;
		
		case '>':
			(int) ${$santa.'_x'}++;
			break;
		
		case '^':
			(int) ${$santa.'_y'}++;
			break;
		
		case 'v':
			(int) ${$santa.'_y'}--;
			break;

	}

	$houses[ (string) ${$santa.'_x'} . '.' . (string) ${$santa.'_y'} ]++;

	$h++;

}

var_dump( count($houses) );
