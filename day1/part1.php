<?php

// http://adventofcode.com/day/1

$input = file_get_contents('input.php');
$input = str_split($input);

$floor = 0;
$character = 1;

foreach($input as $char) {

    switch ($char) {

        case '(':
            $floor++;
            break;
        
        case ')':
            $floor--;
            break;

    }

}

var_dump($floor);
