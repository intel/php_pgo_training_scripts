<?php
/**************************************************************************
* Pgo Train Benchmark
*
* Copyright (c) 2016, Intel Corporation.
*
* This program is free software; you can redistribute it and/or modify it
* under the terms and conditions of the GNU General Public License,
* version 2, as published by the Free Software Foundation.
*
* This program is distributed in the hope it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
* FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
* more details.
***************************************************************************/

/**
*	This php file contains calls to standard string processing functions.
*	Each standard call function have a "run_string_" prefix.
*/
$split_strings = array();

function  repcb($matches) {
    return "s";
}

function run_unserialize($strings_array) {
	$ser_array = serialize($strings_array);
	$ser_no = STRING_SERIALIZE_IT;
	
	for ($i=0; $i < STRING_SERIALIZE_IT; $i++) {
		$ser_array = serialize($strings_array);
	}

	for ($i=0; $i < STRING_UNSERIALIZE_IT; $i++) {
		$var = unserialize($ser_array);
	}
}

function run_string_preg_replace($strs) {
	$patterns = array("/process/", "/Intel/", "/10/", "/DOS/", "/uranium/", "/php/");
	$replacements = array("thread", "Spark", "12", "MS", "Iron", "python");
	
	$len = sizeof($strs);
	for ($i = 0; $i < STRING_PREG_REPLACE_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$rez = preg_replace($patterns, $replacements, $strs[$j]);
			$rez = preg_replace('/\s+/', '_', $rez);	
			$rez1 = preg_replace('/[1-9]/', "1", $strs[$j]);
			$rez2 = preg_replace('/[A-Z]/', "_",$rez1);
			$rez3 = preg_replace('/[a-z]+/', "*", $rez2);
			//echo $rez3;
		}

	}
}
function run_string_preg_replace_callback($strs) {

	$patterns = array("/process/", "/Intel/", "/10/", "/DOS/", "/uranium/", "/php/");
	$replacements = array("thread", "Spark", "12", "MS", "Iron", "python");
	
	$len = sizeof($strs);
	for ($i = 0; $i < STRING_PREG_REPLACE_CALLBACK_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$rez = preg_replace_callback($patterns, 'repcb', $strs[$j]);
			$rez = preg_replace_callback('/\s+/', 'repcb', $rez);	
			$rez1 = preg_replace_callback('/[1-9]/', 'repcb', $strs[$j]);
			$rez2 = preg_replace_callback('/[A-Z]/', 'repcb',$rez1);
			$rez3 = preg_replace_callback('/[a-z]+/', 'repcb', $rez2);
		}
	}
}
function run_string_str_replace($strs) {
	
	$patterns = array("/process/", "/Intel/", "/10/", "/DOS/", "/uranium/", "/php/");
	$replacements = array("thread", "Spark", "12", "MS", "Iron", "python");

	$len = sizeof($strs);
	for ($i = 0; $i < STRING_STR_REPLACE_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$rez = str_replace($patterns, $replacements, $strs[$j]);
			$rez = str_replace('/\s+/', '_', $rez);	
			$rez1 = str_replace('/[1-9]/', "1", $strs[$j]);
			$rez2 = str_replace('/[A-Z]/', "_",$rez1);
			$rez3 = str_replace('/[a-z]+/', "*", $rez2);
		}

	}
}

function run_string_preg_split($strs) {
	$len = sizeof($strs);
	$GLOBALS['split_strings'] = array();
	for ($i = 0; $i < STRING_SPLIT_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$keywords = preg_split("/[\s,]+/", $strs[$j]);
			if ($i == 0 && $j==0)
				array_push($GLOBALS['split_strings'], $keywords);
		}

	}

}
function run_string_strtolower($strs) {
	$len = sizeof($strs);
	for ($i = 0; $i < STRING_STRTOLOWER_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$val = mb_strtolower($strs[$j]);
		}
	}
}

function run_string_in_array($strs) {
	$strs = $GLOBALS['split_strings'];
	$len = sizeof($strs);
	for ($i = 0; $i < STRING_IN_ARRAY_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$ret_val = in_array("a", $strs[$j]);
			$ret_val1 = in_array("1", $strs[$j]);
			$ret_val2 = in_array("the", $strs[$j]);
			$ret_val3 = in_array("The", $strs[$j]);
			$ret_val4 = in_array("Intel", $strs[$j]);
			$ret_val5 = in_array("php", $strs[$j]);
		}
	}
	unset($GLOBALS['split_strings']);
}

function run_string_check_encoding($strs) {
	$len = sizeof($strs);
	for ($i = 0; $i < STRING_CHECKENCODING_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			if (function_exists('mb_check_encoding')) {
				if (mb_check_encoding($strs[$j], 'ASCII')){
					$x = $strs[$j][0];
				}
			}
		}
	}
}
function run_string_echo($strs) {
	$strs = $GLOBALS['split_strings'];
	$len = sizeof($strs);
	for ($i = 0; $i < STRING_ECHO_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$num_tokens = sizeof($strs[$j]);
			for ($k = 0; $k < $num_tokens; $k++) {
				echo $strs[$j][$k] . " " . $strs[$j][$k]; 
			}
		}
	}
}

function run_string_concat($strs) {
	
	for($i = 0; $i < STRING_CONCAT_IT; $i++) {
		$var = STRING_ECHO_IT . ' ' . STRING_CHECKENCODING_IT . ' ' . STRING_STRTOLOWER_IT . "/this/is/some/random/path";
		$var1 = $var . ' - ' . $GLOBALS['s7'];
		$var2 = "I am happy." . "\n" . "You are " . SQL_QUERIES_IT . "x happier ";
		$num_var = 32;
		$ret = $var1 . (string) $num_var;
	}

}

function run_string_trim($str) {
	for($i = 0; $i < STRING_TRIM_IT; $i++) {
		$s = trim($str, " \t\n}{"); 
	}
}

function run_string_md5($str) {
	for($i = 0; $i < STRING_MD5_IT; $i++) {
		$s = md5($str); 
	}	
}

function run_string_implode($strings_array) {
	for($i = 0; $i < STRING_IMPLODE_IT; $i++) {
		$s = implode($strings_array); 
	}	
}