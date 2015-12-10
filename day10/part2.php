<?php

// http://adventofcode.com/day/10

ini_set('memory_limit', '-1');

function getBrokenUp($string) {

    $array = str_split($string);
    $final = array();

    $buildup = '';

    foreach ($array as $key => $char) {
        $buildup .= $char;
        if($char !== $array[$key + 1]) {
            $final[] = $buildup;
            $buildup = '';
        }
    }

    return $final;

}

function getResult($data) {

    $string = '';
    foreach($data as $item) {
        $string .= strlen($item).str_split($item)[0];
    }
    return $string;

}

$string = '1113122113';

for($r = 1; $r <= 50; $r++) {

    $array = getBrokenUp($string);
    $string = getResult($array);

}

var_dump(strlen($string));
