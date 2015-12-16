<?php

// http://adventofcode.com/day/16

$input = file_get_contents('input.php');
$data = explode("\n", $input);

$ingredients = array();

$mySue = array(
	'children'		=> 3,
	'cats'			=> 7,
	'samoyeds'		=> 2,
	'pomeranians'	=> 3,
	'akitas'		=> 0,
	'vizslas'		=> 0,
	'goldfish'		=> 5,
	'trees'			=> 3,
	'cars'			=> 2,
	'perfumes'		=> 1
);

foreach ($data as $key => $row) {

	$re = "/Sue (\\d+): (\\w*): (\\d+)\\, (\\w*): (\\d+)\\, (\\w*): (\\d+)/";
	preg_match($re, $row, $matches);
	list(, $number, $item_1, $val_1, $item_2, $val_2, $item_3, $val_3) = $matches;

	$sues[ $number ] = array(
		$item_1	=> (int) $val_1,
		$item_2	=> (int) $val_2,
		$item_3	=> (int) $val_3
	);

}

foreach ($sues as $number => $data) {

	$ok = true;

	foreach ($data as $name => $value) {

		if( in_array($name, array('cats','trees')) ) {

			$ok = $mySue[$name] < $value;
			if(!$ok) break;

		} elseif( in_array($name, array('pomeranians','goldfish')) ) {

			$ok = $mySue[$name] > $value;
			if(!$ok) break;
			
		} elseif($mySue[$name] !== $value) {
			
			$ok = false;
			break;

		}

	}

	if($ok) {

		var_dump($number);
		break;

	}

}
