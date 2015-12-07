<?php

// http://adventofcode.com/day/5

function checkDoubleLetter($string) {

	$pairs = array();

	$array = str_split($string);

	foreach($array as $pos => $char) {

		if( !$array[$pos + 1] ) continue;

		$pair = $char . $array[$pos + 1];

		//var_dump('checking', $pair, $array[$pos + 2]);]

		$same_and_different = $char === $array[$pos + 1] ? $char !== $array[$pos + 2] : true;

		if(!$same_and_different) continue;

		if( in_array($pair, $pairs) && $same_and_different ) return true;

		$pairs[] = $pair;

	}

	return false;

}

function checkRepeatingLetters($string) {

	$array = str_split($string);

	foreach($array as $pos => $char) {

		$next_2 = $array[ $pos + 2 ];

		if( !$next_2 ) continue;

		if( $next_2 === $char ) return true;

	}

	return false;

}


$input = file_get_contents('input.php');
$array = explode("\n", $input);
//$array = array('qjhvhtzxzqqjkmpb', 'xxyxx', 'uurcxstgmygtbstg', 'ieodomkazucvgmuy');

$nice_list = array();

foreach($array as $string) {

	$ok = true;

	$ok = $ok ? checkDoubleLetter($string) : false;

	$ok = $ok ? checkRepeatingLetters($string) : false;

	//if( strpos($string, "ddd") > 0 ) var_dump($string, checkDoubleLetter($string), checkRepeatingLetters($string));

	if($ok) $nice_list[] = $string;

}

var_dump( count($nice_list) );