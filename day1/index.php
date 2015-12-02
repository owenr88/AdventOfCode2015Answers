<?php

$input = file_get_contents('input.php');
$input = str_split($input);

$starting_floor = 0;
$character = 1;

foreach($input as $char) {

    switch ($char) {

        case '(':
            $starting_floor++;
            break;
        
        case ')':
            $starting_floor--;
            break;

    }

    if($starting_floor === -1) {
        $basement_pos = $character;
        break;
    }

    $character++;

}

var_dump($starting_floor, $basement_pos);
