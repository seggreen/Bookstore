<?php
	$nums = [1, 2, 3, 4];

	/*function multi($a, $b, $c) {
		return $a * $b * $c;
	}

	foreach($nums as $val) {
		echo multi($val, $val, $val);
	}*/


	function square($x) {
		return $x * $x;
	}

	$newArray = array_map('square', $nums);

	print_r($newArray);

