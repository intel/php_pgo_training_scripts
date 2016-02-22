<?php
//require_once('constants.php');
require_once('constants.php');
define('NOT_USED', 420);
define('NOT_USED1', 777);
$var_g = "The Intel Core microarchitecture (previously known as the Next-Generation Micro-Architecture)";// is a multi-core processor microarchitecture unveiled by Intel in Q1 2006. It is based on the Yonah processor design and can be considered an iteration of the P6 microarchitecture, introduced in 1995 with Pentium Pro. The high power consumption and heat intensity, the resulting inability to effectively increase clock speed, and other shortcomings such as the inefficient pipeline were the primary reasons for which Intel abandoned the NetBurst microarchitecture and switched to completely different architectural design, delivering high efficiency through a small pipeline rather than high clock speeds. The Core microarchitecture never reached the clock speeds of the Netburst microarchitecture, even after moving to 45 nm lithography.";
$var1_g = "The = Intel = Core";
$some_url_g = "http://CentOs:password@intel:8080/go?arg=link#text";
$test_array1_g = preg_split("/[\s,]+/", $var1_g); 
$test_array_g = preg_split("/[\s,]+/", $var_g);

function do_nothing(&$item, $key) {
	// nothing at all 
}
function replace($word) {
	return "this->" . $word;
}

function run_standard_calls() {
	$test_array = $GLOBALS['test_array_g'];
	$test_array1 = $GLOBALS['test_array1_g'];
	for ($i = 0 ; $i < STANDARD_CALL_IT; $i++ ) {
		ini_set('set_ini',1);
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		array_walk($test_array, 'do_nothing');
		krsort($test_array);
		ksort($test_array);
		parse_str($var1);
		end($test_array);
		reset($test_array);
		array_shift($test_array);
		array_pop($test_array);
		array_diff($test_array1, $test_array);
		extract($test_array, EXTR_PREFIX_SAME, "wddx");
		//printf("%.02lf\n", 1.035);
		$ks = array_keys($test_array);
		
	}

}
function run_array_map() {
	$test = $GLOBALS['test_array1_g'];
	for ($i = 0; $i<ARRAY_MAP_IT; $i++) {
		$rez = array_map("replace", $test);
	}
}
function run_array_merge() {
	$test = $GLOBALS['test_array1_g'];
	$test1 = $GLOBALS['test_array_g'];
	$last = $test;
	for ($i = 0; $i<ARRAY_MERGE_IT; $i++) {
		$rez = array_merge($test1, $test);
		
	}
}
function run_preg_match() {
	$subject = "abcdef abcdefabcdefabcdef abcdef abcdefabcdefabcdefabcdef abcdefabcdefabcdef abcdef abcdefabcdefabcdef abcdef abcdefabcdefabcdefabcdef abcdefabcdefabcdef";
	$pattern = '/^def/';
	for ($i = 0; $i<PREG_MATCH_IT; $i++) {
		preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
	}
}

function run_parse_url() {
	$some_url = $GLOBALS['some_url_g'];
	for($i=0; $i < PARSE_URL_IT; $i++) {
		$v = parse_url($some_url);
	}	
}

function run_version_compare() {
	for ($i = 0; $i < VERSION_COMPARE_IT; $i++ ) {
		$v1 = version_compare(phpversion(), '5.5', '>=');
		$v2 = version_compare(phpversion(), '7.0', '<=');
		
	}
}	
function run_file_exists() {
	for ($i = 0; $i < FILE_EXISTS_IT; $i++ ) {
	
		if (file_exists("generic.txt")) {
			$v = 1;
		}
		if (file_exists("not-a-file.txt")) {
			$v2 = 2;
		}
	}
}
function run_file_operations() {
	
	for ($i = 0; $i < FILE_OPS_IT; $i++ ) {
		$file = fopen("generic.txt", "r");
		$rez = fread($file,"1024");
		fclose($file);
	}
}
function run_func_exists() {
	for ($i=0; $i < FUNC_EXISTS_IT ; $i++)
		if (function_exists("version_compare"))
			if(function_exists("run_preg_match"))
				if(function_exists("fff-XXxX"))
				{	//do nothing
				}
}
?>