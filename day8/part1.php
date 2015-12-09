<?php

// http://adventofcode.com/day/8

function findString($code) {

	// Get the inside string
	preg_match("/\"(.*)\"/", $code, $string);
	$string = $string[1];

	// Check if there are any ASCii characters
	$re = "/(\\\\x[0-9A-Fa-f]{2})/"; 
	preg_match_all($re, $string, $ascii_chars);
	$ascii_chars = $ascii_chars[1];
	if( !empty($ascii_chars) ) {
		foreach ($ascii_chars as $value) {
			$new_value = chr(hexdec($value));
			if( strlen($new_value) !== 1 ) $new_value = "*";
			$string = str_replace($value, $new_value, $string);
		}
	}
	
	// Remove other slashes AND the value
	$string = stripslashes($string);

	return $string;

}

$input = file_get_contents('input.php');
$data = explode("\n", $input);

$characters_of_code = 0;
$characters_in_memory = 0;

foreach($data as $code) {

	// Remove white space
	trim($code);

	// Do what's needed to the code to get the string
	$string = findString($code);

	// Set the counts
	$characters_of_code += strlen($code);
	$characters_in_string += strlen($string);

};

var_dump( $characters_of_code - $characters_in_string );
