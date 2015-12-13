<?php

// http://adventofcode.com/day/11

function excludesNonAllowed($input) {

    $re = "/([i|o|l]+)/m"; 
    preg_match($re, $input, $matches);

    if(empty($matches)) return true;

    return false;

}

function hasPairs($input) {

    $re = "/([a-z])(?=\\1)/"; 
    preg_match($re, $input, $matches);
    if(empty($matches)) return false;

    $re = "/([a-z])(?=\\1)[^".$matches[0]."]/"; 
    preg_match($re, $input, $matches);
    if(empty($matches)) return false;

    return true;

}

function hasStraightLetters($input) {

    $letters = str_split($input);

    foreach($letters as $key => $letter) {

        $next_inc_letter = $letter;
        if($next_inc_letter === 'z') {
            $next_inc_letter = '';
        } else {
            $next_inc_letter++;
        }

        $next_next_inc_letter = $next_inc_letter;
        if($next_next_inc_letter === 'z') {
            $next_next_inc_letter = '';
        } else {
            $next_next_inc_letter++;
        }

        $next_letter_in_string = isset($letters[$key+1]) ? $letters[$key+1] : false;
        $next_next_letter_in_string = isset($letters[$key+1]) ? $letters[$key+2] : false;

        if(!$next_letter_in_string || !$next_next_letter_in_string) break;

        $is_next_inc = $next_letter_in_string === $next_inc_letter;
        $is_next_next_inc = $next_next_letter_in_string === $next_next_inc_letter;

        if($is_next_inc && $is_next_next_inc) return true;

    }

    return false;

}

function increment($string) {

    $string++;

    return $string;

}

function checkMe($string) {

    $excludesNonAllowed = excludesNonAllowed($string);
    $hasPairs = $excludesNonAllowed ? hasPairs($string) : false;
    $hasStraightLetters = $hasPairs ? hasStraightLetters($string) : false;

    $ok = $hasStraightLetters && $excludesNonAllowed && $hasPairs;

    return array($ok, $string);

}

function getNextPassword($string) {

    for($r = 1; $r <= 10000000; $r++) {

        strtolower($string);
        $string = increment($string);

        list($is_ok, $string) = checkMe($string);

        if($is_ok) return $string;

    }

    return false;

}


$old_password = 'hxbxwxba';

$next_password = getNextPassword($old_password);

var_dump('the next password is ' . $next_password);
