<?php

// http://adventofcode.com/day/17

ini_set('memory_limit', '-1');

$containers = file('input.php', FILE_IGNORE_NEW_LINES);

arsort($containers);

$litres = 150;

$combinations = array();

foreach ($containers as $key => $value) {
	if( count(array_keys($containers, $value)) > 1) {
		foreach (array_keys($containers, $value) as $count => $key_with_val) {
			$containers[$key_with_val] = $value . '_' . $count;
		}
	}
}

function getCombinations($containers_left, $remaining, $no_of_containers) {

    global $combinations;

    while(count($containers_left)) {

        $this_container = array_shift($containers_left);

        if($this_container == $remaining) {

            $combinations[$no_of_containers]++;

        } else if($this_container < $remaining) {

            getCombinations($containers_left, $remaining - $this_container, $no_of_containers+1);

        }

    }

}

getCombinations($containers, $litres, 1);

var_dump( min($combinations) );
