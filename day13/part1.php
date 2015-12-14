<?php

// http://adventofcode.com/day/13

$input = file_get_contents('input.php');
$data = explode("\n", $input);

$formatted_data = formatData($data);
$all_people = array_keys($formatted_data);
$all_arrangements = array();


function formatRow($row) {

	$re = "/([\\w]*) would ([\\w]*) ([\\d]*) happiness units by sitting next to ([\\w]*)\\./"; 
	preg_match($re, $row, $matches);
	return $matches;

}

function formatData($data) {

	$final = array();

	foreach ($data as $key => $row) {

		list(, $person_1, $feeling, $units, $person_2) = formatRow($row);

		if(!isset($final[$person_1])) $final[$person_1] = array();

		$final[$person_1][$person_2] = $feeling === 'lose' ? -$units : +$units;

	}

	return $final;

}

function getTwoPeopleSum($person_1, $person_2) {

	$data = $GLOBALS['formatted_data'];

	if(!isset($data[$person_1]) || !isset($data[$person_2]) || $person_1 == $person_2) return (int) 0;

	$sum = +$data[$person_1][$person_2] + $data[$person_2][$person_1];

	return $sum;

}

function getValues($varieties) {

	$final = array();

	foreach ($varieties as $key => $string) {

		$array = explode(" ", $string);

		$total = 0;

		for($r = 0; $r <= count($array)-1; $r++) {

			$total += getTwoPeopleSum($array[$r], $array[$r+1]);

		}

		$total += getTwoPeopleSum($array[0], $array[count($array)-1]);

		$final[$string] = $total;

	}

	return $final;

}

function pc_permute($left_to_check, $checked_people = array( ), $last_person = false) {

    if (empty($left_to_check)) { 

    	$GLOBALS['all_arrangements'][] = join(' ', $checked_people);

    }  else {

        for ($i = count($left_to_check) - 1; $i >= 0; --$i) {

            $new_left_to_check = $left_to_check;
            $new_checked_people = $checked_people;
            list($this_person) = array_splice($new_left_to_check, $i, 1);
            array_unshift($new_checked_people, $this_person);
            pc_permute($new_left_to_check, $new_checked_people, $this_person);

        }

    }

}

pc_permute($all_people, array());

$values = getValues($GLOBALS['all_arrangements']);

var_dump( max($values) );
