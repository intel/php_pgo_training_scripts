<?php
/**
* PHP PGO Training - to be used during Profile Guided Optimization builds.
*
* Copyright (C) 2016 Intel Corporation
*
* This program is free software and open source software; you can redistribute
* it and/or modify it under the terms of the GNU General Public License as
* published by the Free Software Foundation; either version 2 of the License,
* or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
* FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
* more details.
*
* You should have received a copy of the GNU General Public License along
* with this program; if not, write to the Free Software Foundation, Inc.,
* 51 Franklin St, Fifth Floor, Boston, MA 02110-1301, USA
* http://www.gnu.org/licenses/gpl.html
*
* Authors:
*   Gabriel Samoila <gabriel.c.samoila@intel.com>
*   Bogdan Andone <bogdan.andone@intel.com>
*/

/* Constants for scaling the number of runs;
 * Users can change these value for tuning execution weights
 */
define('STANDARD_CALL_IT', 10000);				/* # of different standard calls */
define('INI_SET_IT',100);						/* # of set_it() calls*/
define('FUNC_EXISTS_IT',1000);					/* # of function_exists() calls */
define('FILE_OPS_IT', 10);						/* # of fopen(), fread(), fclose() calls */
define('FILE_EXISTS_IT', 500);					/* # of file_exists() calls */
define('ARRAY_MAP_IT', 4200);					/* # of array_map() calls */
define('ARRAY_MERGE_IT', 12500);				/* # of array_merge() calls */
define('PREG_MATCH_IT', 10000);					/* # of preg_match() calls */
define('PARSE_URL_IT', 1000);					/* # of parse_url() calls */
define('VERSION_COMPARE_IT', 1200);				/* # of version_compare() calls */

/* entry point for this module will be added into
	array if required extensions exists */
function standard_register_training(& $functions)
{
	if (!extension_loaded("standard")) {
		echo "<WARNING> Standard benchmark module not loaded: standard extension is missing\n";
		return -1;
	}

	echo "Standard benchmark module loaded!\n";
	$functions[] = "run_standard";
}

/** Standard php calls. Use variables defined below to
*	control the proportions of different standard calls.
*/
function run_standard() {
	$STANDARD_CALL_PARAM = STANDARD_CALL_IT;
	$INI_SET_PARAM = INI_SET_IT;
	$FUNC_EXISTS_PARAM = FUNC_EXISTS_IT;
	$FILE_OPS_PARAM = FILE_OPS_IT;
	$FILE_EXISTS_PARAM = FILE_EXISTS_IT;
	$ARRAY_MAP_PARAM = ARRAY_MAP_IT;
	$VERSION_COMPARE_PARAM = VERSION_COMPARE_IT;
	$ARRAY_MERGE_PARAM = ARRAY_MERGE_IT;
	$PREG_MATCH_PARAM  = PREG_MATCH_IT;
	$PARSE_URL_PARAM = PARSE_URL_IT;


	run_standard_calls($STANDARD_CALL_PARAM);
	run_array_map($ARRAY_MAP_PARAM);
	run_array_merge($ARRAY_MERGE_PARAM);
	run_preg_match($PREG_MATCH_PARAM);
	run_parse_url($PARSE_URL_PARAM);
	run_version_compare($VERSION_COMPARE_PARAM);
	run_file_exists($FILE_EXISTS_PARAM);
	run_file_operations($FILE_OPS_PARAM);
	run_ini_set($INI_SET_PARAM);
}

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

function run_standard_calls($STANDARD_CALL_IT) {
	$var = "The Intel Core microarchitecture (previously known as the Next-Generation Micro-Architecture)";// is a multi-core processor microarchitecture unveiled by Intel in Q1 2006. It is based on the Yonah processor design and can be considered an iteration of the P6 microarchitecture, introduced in 1995 with Pentium Pro. The high power consumption and heat intensity, the resulting inability to effectively increase clock speed, and other shortcomings such as the inefficient pipeline were the primary reasons for which Intel abandoned the NetBurst microarchitecture and switched to completely different architectural design, delivering high efficiency through a small pipeline rather than high clock speeds. The Core microarchitecture never reached the clock speeds of the Netburst microarchitecture, even after moving to 45 nm lithography.";
	$var1 = "The = Intel = Core";
	$some_url = "http://CentOs:password@intel:8080/go?arg=link#text";
	$test_array1 = preg_split("/[\s,]+/", $var1);
	$test_array = preg_split("/[\s,]+/", $var);

	for ($i = 0 ; $i < $STANDARD_CALL_IT; $i++ ) {
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		array_walk($test_array, 'do_nothing');
		krsort($test_array);
		ksort($test_array);
		parse_str($var1, $dummy);
		end($test_array);
		reset($test_array);
		array_shift($test_array);
		array_pop($test_array);
		array_diff($test_array1, $test_array);
		extract($test_array, EXTR_PREFIX_SAME, "wddx");
		$ks = array_keys($test_array);

	}

}
function run_ini_set($INI_SET_IT) {
	$fname='ini_set';
	for ($i = 0 ; $i < $INI_SET_IT; $i++ ) {

		$fname('set_ini',1);
	}
}

function run_array_map($ARRAY_MAP_IT) {
	$test = $GLOBALS['test_array1_g'];
	$fname = "array_map";
	for ($i = 0; $i<$ARRAY_MAP_IT; $i++) {
		$rez = $fname("replace", $test);
	}
}
function run_array_merge($ARRAY_MERGE_IT) {
	$test = $GLOBALS['test_array1_g'];
	$test1 = $GLOBALS['test_array_g'];
	$last = $test;
	$fname = "array_merge";
	for ($i = 0; $i<$ARRAY_MERGE_IT; $i++) {
		$rez = $fname($test1, $test);

	}
}
function run_preg_match($PREG_MATCH_IT) {
	$subject = "abcdef abcdefabcdefabcdef abcdef abcdefabcdefabcdefabcdef abcdefabcdefabcdef abcdef abcdefabcdefabcdef abcdef abcdefabcdefabcdefabcdef abcdefabcdefabcdef";
	$pattern = '/^def/';
	$fname = "preg_match";
	for ($i = 0; $i<$PREG_MATCH_IT; $i++) {
		$fname($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
	}
}

function run_parse_url($PARSE_URL_IT) {
	$some_url = $GLOBALS['some_url_g'];
	$fname = "parse_url";
	for($i=0; $i < $PARSE_URL_IT; $i++) {
		$v = $fname($some_url);
	}
}

function run_version_compare($VERSION_COMPARE_IT) {
	for ($i = 0; $i < $VERSION_COMPARE_IT; $i++ ) {
		$v1 = version_compare(phpversion(), '5.5', '>=');
		$v2 = version_compare(phpversion(), '7.0', '<=');

	}
}
function run_file_exists($FILE_EXISTS_IT) {
	for ($i = 0; $i < $FILE_EXISTS_IT; $i++ ) {

		if (file_exists("generic.txt")) {
			$v = 1;
		}
		if (file_exists("not-a-file.txt")) {
			$v2 = 2;
		}
	}
}
function run_file_operations($FILE_OPS_IT) {
	$fname = "fopen";
	for ($i = 0; $i < $FILE_OPS_IT; $i++ ) {
		$file = $fname("generic.txt", "r");
		$rez = fread($file,"1024");
		fclose($file);
	}
}
function run_func_exists($FUNC_EXISTS_IT) {
	$fname = "function_exists";
	for ($i=0; $i < $FUNC_EXISTS_IT ; $i++)
		if ($fname("version_compare"))
			if($fname("run_preg_match"))
				if($fname("fff-XXxX"))
				{	//do nothing
				}
}
?>
