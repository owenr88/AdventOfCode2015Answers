<?php

// http://adventofcode.com/day/7

ini_set('memory_limit', '-1');


function createArray($array) {

	$return = array();

	foreach($array as $line) {
		
		$bits = explode(" ", $line);

		$splitter_position = array_search("->", $bits);

		$var = $bits[ $splitter_position + 1 ];

		switch ($splitter_position) {

			case '1': // Direct operator
				$operator = 'EQUALS';
				$val1 = 0;
				$val2 = $bits[0];
				break;

			case '2': // Not operator
				$operator = $bits[0];
				$val1 = 65535;
				$val2 = $bits[1];
				break;

			case '3': // Comparison operator
				$operator = $bits[1];
				$val1 = $bits[0];
				$val2 = $bits[2];
				break;

		}

		$return[$var] = array(
			'var'	=> $var,
			'val1'	=> $val1,
			'op'	=> $operator,
			'val2'	=> $val2,
		);

	}

	return $return;

}

function doBitwise($op, $val1, $val2, $data, $final) {

	if( !is_numeric($val1) ) {

		if( !isset($final[$val1]) ) {
			$val1 = getLineData($data[$val1], $final, $data);
		}

		$val1 = $final[$val1];

	}

	if( !is_numeric($val2) ) {

		if( !isset($final[$val2]) ) {
			$val2 = getLineData($data[$val1], $final, $data);
		}

		$val2 = $final[$val2];

	}

	(int) $val1;
	(int) $val2;

	//var_dump($val1, $val2);

	switch ($op) {

		case 'NOT':
			return ($val1 & ~ $val2);
			break;

		case 'EQUALS':
			return $val2;
			break;

		case 'AND':
			return ($val1 & $val2);
			break;

		case 'OR':
			return ($val1 | $val2);
			break;

		case 'LSHIFT':
			return ($val1 << $val2);
			break;

		case 'RSHIFT':
			return ($val1 >> $val2);
			break;
		
	}

}


function getLineData($line, $final, $data) {

	$return = doBitwise($operator, $val1, $val2, $data, $final);

	if($return === 65535) continue;

	$final[$var] = (int) $return;

}
 

$input = file_get_contents('input.php');
$data = explode("\n", $input);
$sorted_data = createArray($data);
ksort($sorted_data);

foreach($sorted_data as $var => $line) {

	$final[$var] = getLineData($line, $final, $sorted_data);

};



ksort($final);
var_dump( $final );
