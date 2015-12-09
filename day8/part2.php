<?php

// http://adventofcode.com/day/8

function findEncodeString($code) {
	
	// Add slashes
	$encoded_string = addslashes($code);

	return '"' . $encoded_string . '"';

}

$input = file_get_contents('input.php');
$data = explode("\n", $input);

$characters_of_code = 0;
$characters_in_memory = 0;

foreach($data as $code) {

	// Remove white space
	trim($code);

	// Do what's needed to the code to get the string
	$encoded_string = findEncodeString($code);

	// Set the counts
	$characters_of_code += strlen($code);
	$characters_in_string += strlen($encoded_string);

	echo $encoded_string . ' - ' . strlen($encoded_string) . ' of string. ' . $code . ' - ' . strlen($code) . ' of code' . "\r\n";

};

var_dump( $characters_in_string - $characters_of_code );
