<?php

// http://adventofcode.com/day/5

function checkVowels($string) {

	$allowed = array('a', 'e', 'i', 'o', 'u');
	$array = str_split($string);

	$count = 0;

	foreach($array as $char) {

		if( in_array($char, $allowed) ) $count++; // increase if one of those texts are in it

	}

	return $count >= 3;

}

function checkDoubleLetter($string) {

	preg_match('/([a-zA-Z])\1+/', $string, $match);

	return ! empty( $match );

}

function doesntContain($string) {

	$not_allowed = array('ab', 'cd', 'pq', 'xy');

	foreach($not_allowed as $text) {

		if( strpos($string, $text) !== false ) return false; // return if one of those texts are in it

	}

	return true;

}


$input = file_get_contents('input.php');
$array = explode("\n", $input);

$nice_list = array();

foreach($array as $string) {

	$ok = true;

	$ok = $ok ? checkVowels($string) : false;

	$ok = $ok ? checkDoubleLetter($string) : false;

	$ok = $ok ? doesntContain($string) : false;

	if($ok) $nice_list[] = $string;

}

var_dump( count($nice_list) );