<?php
function get_string_from_number8($n) {
   /* set string length to 16 - 16+32  */
   $size = 16 + ($n % 32);
   $string = 'q' . $n;
   for ($i = strlen($string); $i < $size; $i++) {
     $string .= "#";
   }
   echo $string . "\n";
   return $string;
 }

function some_func8() {
	$STANDARD_CALL_IT = 100000;
	$INI_SET_IT = 1000;
	$FUNC_EXISTS_IT = 10000;
	$FILE_OPS_IT = 100;
	$FILE_EXISTS_IT = 5000;
	$ARRAY_MAP_IT = 42000;
	$VERSION_COMPARE_IT = 12000;
	$ARRAY_MERGE_IT = 125000;
	$PREG_MATCH_IT  = 100000;
	$PARSE_URL_IT = 10000;
}
?>
