<?php
function one() {
	return 1;
}
function run_hash_array() {
	$keys = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'zero'); 
	$values = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
	$len = sizeof($keys);
	for ($j = 0 ; $j < HASH_IT; $j++){
		$hmap = array();
		for ($i = 0; $i < $len; $i++) {
			//echo $keys[$i];
			$hmap[$keys[$i]] = 420;
			array_map("one", $hmap);
		}
	}
}

?>