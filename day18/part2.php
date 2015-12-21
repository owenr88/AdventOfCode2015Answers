<?php

// http://adventofcode.com/day/18

function getStatus($y, $x, $array) {

    $current = $array[$y][$x];

    $neighbours = array(
        'top'           => $array[$y-1][$x],
        'top_right'     => $array[$y-1][$x+1],
        'right'         => $array[$y][$x+1],
        'bottom_right'  => $array[$y+1][$x+1],
        'bottom'        => $array[$y+1][$x],
        'bottom_left'   => $array[$y+1][$x-1],
        'left'          => $array[$y][$x-1],
        'top_left'      => $array[$y-1][$x-1]
    );

    $on = array_keys($neighbours, '#');
    $off = array_keys($neighbours, '.');

    $max = count($array);

    if( ($x===1&&$y===1) || ($x===1&&$y===$max) || ($x===$max&&$y===1) || ($x===$max&&$y===$max) ) {
        $return = '#';
    } elseif( $current === '#' && (count($on) == 2 || count($on) == 3) ) {
        $return = '#';
    } elseif($current === '.' && count($on) == 3 ) {
        $return = '#';
    } else {
        $return = '.';
    }

    return $return;

}

function getCounts($grid_arr) {

    for ($y=1; $y <= count($grid_arr); $y++) { 

        for ($x=1; $x <= count($grid_arr[$y]); $x++) { 

            $status = getStatus($y, $x, $grid_arr);

            $final_arr[$y][$x] = $status;

            $final_counts[ $status ]++;

        }

    }

    return array($final_counts, $final_arr);

}

$grid = file('input.php', FILE_IGNORE_NEW_LINES);

foreach ($grid as $y => $row) {

    $row = str_split($row);

    foreach ($row as $x => $char) {

        $grid_arr[$y+1][$x+1] = $char;

    }

}

$max = count($grid_arr);
$grid_arr[1][1] = '#';
$grid_arr[1][$max] = '#';
$grid_arr[$max][1] = '#';
$grid_arr[$max][$max] = '#';

for ($p=1; $p <= 100; $p++) { 

    list($final_counts, $grid_arr) = getCounts($grid_arr);

}

var_dump( $final_counts['#'] );
