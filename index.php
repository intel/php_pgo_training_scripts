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

require_once('constants.php');
include 'db.php';
include 'time.php';
include 'string.php';
include 'standard_calls.php';
include 'class.php';
include 'check_extensions.php';
include 'dictionary.php';

/**
*	Include huge sections of php code in order to
* train compile section for consecutive requests.
*/
// include ("dummy_functions/f0.php");
// include ("dummy_functions/f2.php");
// include ("dummy_functions/f3.php");
// include ("dummy_functions/f4.php");
// include ("dummy_functions/f5.php");
// include ("dummy_functions/f6.php");
// include ("dummy_functions/f7.php");
// include ("dummy_functions/f8.php");
// include ("dummy_functions/f9.php");

/**
*	Include huge section of class code.
*/
// include ("dummy_functions/class_f0.php");
// include ("dummy_functions/class_f2.php");
// include ("dummy_functions/class_f3.php");
// include ("dummy_functions/class_f4.php");
// include ("dummy_functions/class_f5.php");
// include ("dummy_functions/class_f6.php");
// include ("dummy_functions/class_f7.php");
// include ("dummy_functions/class_f8.php");
// include ("dummy_functions/class_f9.php");

/**
*	Calls Mysql functions from db.php
*/
function run_mysql_queries() {
	$newDB = new db(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
	/* if extension is missing goto next bench module */
	if (!extension_loaded("mysqli")) {
		echo "Mysqli is missing!\n";
		return -1;
	}

	if (!$newDB->check_connection())
		die("Connection closed...");
	else {
		$names = array("\"WinnieThePooh\"" , "\"Mickey Mouse\"", "\"something\"", "\"random_name\"", "\"YetAnotherName\"", "\"NotINTable\"");
		for ($i=0; $i < SQL_QUERIES_IT; $i++) {
			first_query($newDB);
			second_query($newDB);
			for ($j = 0; $j < 10; $j++){
				select_simple_WHERE($newDB, " * ", "col2", $names[$j%6]);
			}
			select_INNER_JOIN($newDB);
			multiple_WHERE_CLAUSES($newDB);
		}	
	}
}

/**
*	Calls related to date/time from time.php
*/
function run_time() {
	/* if extension is missing goto next bench module */
	if (!extension_loaded("date")) {
		echo "Date is missing!\n";
		return -1;
	}
	run_strtotime();
	run_date();
}

/**
*	Calls all string processing functions from string.php
*/
function run_string() {

	/* goto next benchmark module if any of standard, 
	 * mbstring or pcre extensions are missing 
	 */
	if (!extension_loaded("standard")) {
		echo "Standard is missing!\n";
		return -1;
	}
	if (!extension_loaded("mbstring")) {
		echo "Mbstring is missing!\n";
		return -1;
	}
		
	if (!extension_loaded("pcre")) {
		echo "Pcre is missing!\n";
		return -1;
	}
	/* Six strings variables and an array used as parameters
	 *	to string processing functions
	 */
	$s0 = "Uranium is a chemical element with symbol U and atomic number 92.
	It is a silvery-white metal in the actinide series of the periodic table.
	A uranium atom has 92 protons and 92 electrons, of which 6 are valence electrons. 
	Uranium is weakly radioactive because all its isotopes are unstable (with half-lives 
	of the six naturally known isotopes, uranium-233 to uranium-238, varying between 69
	years and 4.5 billion years). The most common isotopes of uranium are uranium-238 
	(which has 146 neutrons and accounts for almost 99.3% of the uranium found in nature)
	and uranium-235 (which has 143 neutrons, accounting for 0.7% of the element found naturally).";

	// ark.intel.com disclaimer
	$s1 = "All information provided is subject to change at any time, without notice. Intel may make changes to manufacturing life cycle, specifications, and product descriptions at any time, without notice. The information herein is provided as-is and Intel does not make any representations or warranties whatsoever regarding accuracy of the information, nor on the product features, availability, functionality, or compatibility of the products listed. Please contact system vendor for more information on specific products or systems.";

	// copy-pasta string
	$s2 = "php benchmark php benchmark php pgo benchmark php pgo benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark pgo php benchmark pgo php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark php benchmark {
		php benchmark php benchmark php benchmark php benchmark pgo php benchmark php benchmark php benchmark pgo php benchmark php benchmark php benchmark php benchmark pgo php benchmark }";

	// random numbers string
	$s3 = "2459
	2410
	0733
	1929
	3572
	0215
	3177
	4755
	2142
	9552
	7666
	9170
	1228
	6619
	6786
	3643
	0727
	3622
	8176
	0395
	0968
	1290
	0356
	3847
	3738
	7112
	1400
	3991
	4314
	8481";

	// random letters string
	$s4 = "FVVLV
	KMGDL
	BUCGC
	RYOZY
	EJKLH
	VYDCY
	GXVTJ
	DOSHX
	JTISW
	FFVSI
	OQISD
	JXFKA
	AMRXI
	TTXXV
	CACIX
	ERWHL
	LUXUW
	MBWNS
	XWUEZ
	GAABL
	VWPGG
	IVQHQ
	QUTUK
	NZAIU
	CHSYU
	GWBPM
	KKXGY
	MIUSN
	HHZBZ
	RTORR";


	$s5 = " { }  
	if (a == b) {
		//do something
		++a;
		} else {
			b +=a;
		}   }  
		";

	// Wikipedia.org Intel Core(microarchitecture)
	$s6 = "The Intel Core microarchitecture (previously known as the Next-Generation Micro-Architecture) is a multi-core processor microarchitecture unveiled by Intel in Q1 2006. It is based on the Yonah processor design and can be considered an iteration of the P6 microarchitecture, introduced in 1995 with Pentium Pro. The high power consumption and heat intensity, the resulting inability to effectively increase clock speed, and other shortcomings such as the inefficient pipeline were the primary reasons for which Intel abandoned the NetBurst microarchitecture and switched to completely different architectural design, delivering high efficiency through a small pipeline rather than high clock speeds. The Core microarchitecture never reached the clock speeds of the Netburst microarchitecture, even after moving to 45 nm lithography.
	The first processors that used this architecture were code-named 'Merom', 'Conroe', and 'Woodcrest'; Merom is for mobile computing, Conroe is for desktop systems, and Woodcrest is for servers and workstations. While architecturally identical, the three processor lines differ in the socket used, bus speed, and power consumption. Mainstream Core-based processors are branded Pentium Dual-Core or Pentium and low end branded Celeron; server and workstation Core-based processors are branded Xeon, while desktop and mobile Core-based processors are branded as Core 2. Despite their names, processors sold as Core Solo/Core Duo and Core i3/i5/i7 do not actually use the Core microarchitecture and are based on the Enhanced Pentium M and newer Nehalem/Sandy Bridge/Haswell/Skylake microarchitectures, respectively.
	The Core microarchitecture returned to lower clock rates and improved the usage of both available clock cycles and power when compared with the preceding NetBurst microarchitecture of the Pentium 4/D-branded CPUs.[1] The Core microarchitecture provides more efficient decoding stages, execution units, caches, and buses, reducing the power consumption of Core 2-branded CPUs while increasing their processing capacity. Intel's CPUs have varied widely in power consumption according to clock rate, architecture, and semiconductor process, shown in the CPU power dissipation tables.
	Like the last NetBurst CPUs, Core based processors feature multiple cores and hardware virtualization support (marketed as Intel VT-x), as well as Intel 64 and SSSE3. However, Core-based processors do not have the Hyper-Threading Technology found in Pentium 4 processors. This is because the Core microarchitecture is a descendant of the P6 microarchitecture used by Pentium Pro, Pentium II, Pentium III, and Pentium M.
	The L1 cache size was enlarged in the Core microarchitecture, from 32 KB on Pentium II/III (16 KB L1 Data + 16 KB L1 Instruction) to 64 KB L1 cache/core (32 KB L1 Data + 32 KB L1 Instruction) on Pentium M and Core/Core 2. It also lacks an L3 Cache found in the Gallatin core of the Pentium 4 Extreme Edition, although an L3 Cache is present in high-end versions of Core-based Xeons. Both an L3 cache and Hyper-threading were reintroduced in the Nehalem microarchitecture.";

	$s7 = " _______           _______  _______  _______  _        _______ 
	(  ____ \|\     /|(  ___  )(       )(  ____ )( \      (  ____ \
	| (    \/( \   / )| (   ) || () () || (    )|| (      | (    \/
	| (__     \ (_) / | (___) || || || || (____)|| |      | (__    
	|  __)     ) _ (  |  ___  || |(_)| ||  _____)| |      |  __)   
	| (       / ( ) \ | (   ) || |   | || (      | |      | (      
	| (____/\( /   \ )| )   ( || )   ( || )      | (____/\| (____/\
	(_______/|/     \||/     \||/     \||/       (_______/(_______/
	                                                               ";
	$strings = array($s0, $s1, $s2, $s3, $s4, $s5, $s6, $s7);

	run_string_preg_replace($strings);
	run_string_preg_replace_callback($strings);
	run_string_preg_split($strings);
	run_string_strtolower($strings);
	run_string_check_encoding($strings);
	run_string_str_replace($strings);
	run_string_in_array($strings);
	run_unserialize($strings);
	run_string_trim($s5);
	run_string_md5($s6);
	run_string_implode($strings);

}

/**
 *  Modify constants in index.php/run_standard_calls()
 *	in order to change the proporions.
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

	if (!extension_loaded("standard")) {
		echo "Standard is missing!\n";
		return -1;
	}
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
function run_class() {
	run_create_classes();
}
function run_hash() {
	run_hash_array();
}


function getmicrotime()
{
  $t = gettimeofday();
  return ($t['sec'] + $t['usec'] / 1000000);
}

function start_test()
{
//	ob_start();
  return getmicrotime();
}

function end_test($start, $name)
{
  global $total;
  $end = getmicrotime();
//  ob_end_clean();
  $total += $end-$start;
  $num = number_format($end-$start,3);
  $pad = str_repeat(" ", 32-strlen($name)-strlen($num));

  echo $name.$pad.$num."\n";
//	ob_start();
  return getmicrotime();
}

function total()
{
  global $total;
  $pad = str_repeat("-", 32);
  echo $pad."\n";
  $num = number_format($total,3);
  $pad = str_repeat(" ", 32-strlen("Total")-strlen($num));
  echo "Total".$pad.$num."\n";
}

check();

$t0 = $t = start_test();
fill_dictionary(DICTIONARY_IT);
$t = end_test($t, "fill_dictionary(". DICTIONARY_IT .")");
fill_dictionary(DICTIONARY_IT);
$t = end_test($t, "fill_dictionary(". DICTIONARY_IT .")");
fill_dictionary(DICTIONARY_IT);
$t = end_test($t, "fill_dictionary(". DICTIONARY_IT .")");
fill_dictionary(DICTIONARY_IT);
$t = end_test($t, "fill_dictionary(". DICTIONARY_IT .")");
echo "--------------------------------\n";
run_mysql_queries();
$t = end_test($t, "run_mysql_queries(" . SQL_QUERIES_IT . ")");
run_mysql_queries();
$t = end_test($t, "run_mysql_queries(" . SQL_QUERIES_IT . ")");
run_mysql_queries();
$t = end_test($t, "run_mysql_queries(" . SQL_QUERIES_IT . ")");
run_mysql_queries();
$t = end_test($t, "run_mysql_queries(" . SQL_QUERIES_IT . ")");
echo "--------------------------------\n";
run_time();
$t = end_test($t, "run_time(" . (STRTOTIME_IT + DATE_IT) . ")");
run_time();
$t = end_test($t, "run_time(" . (STRTOTIME_IT + DATE_IT) . ")");
run_time();
$t = end_test($t, "run_time(" . (STRTOTIME_IT + DATE_IT) . ")");
run_time();
$t = end_test($t, "run_time(" . (STRTOTIME_IT + DATE_IT) . ")");
echo "--------------------------------\n";
run_string();
$t = end_test($t, "run_string(" . (STRING_CHECKENCODING_IT + STRING_PREG_REPLACE_IT +
                                    STRING_STR_REPLACE_IT + STRING_SPLIT_IT + STRING_STRTOLOWER_IT) . ")");
run_string();
$t = end_test($t, "run_string(" . (STRING_CHECKENCODING_IT + STRING_PREG_REPLACE_IT +
                                    STRING_STR_REPLACE_IT + STRING_SPLIT_IT + STRING_STRTOLOWER_IT) . ")");
run_string();
$t = end_test($t, "run_string(" . (STRING_CHECKENCODING_IT + STRING_PREG_REPLACE_IT +
                                    STRING_STR_REPLACE_IT + STRING_SPLIT_IT + STRING_STRTOLOWER_IT) . ")");
run_string();
$t = end_test($t, "run_string(" . (STRING_CHECKENCODING_IT + STRING_PREG_REPLACE_IT +
                                    STRING_STR_REPLACE_IT + STRING_SPLIT_IT + STRING_STRTOLOWER_IT) . ")");
echo "--------------------------------\n";
run_standard();
$t = end_test($t, "run_standard(" . STANDARD_CALL_IT . ")");
run_standard();
$t = end_test($t, "run_standard(" . STANDARD_CALL_IT . ")");
run_standard();
$t = end_test($t, "run_standard(" . STANDARD_CALL_IT . ")");
run_standard();
$t = end_test($t, "run_standard(" . STANDARD_CALL_IT . ")");
echo "--------------------------------\n";
run_class();
$t = end_test($t, "run_class(" . CLASS_STUDENT_IT . ")");
run_class();
$t = end_test($t, "run_class(" . CLASS_STUDENT_IT . ")");
run_class();
$t = end_test($t, "run_class(" . CLASS_STUDENT_IT . ")");
run_class();
$t = end_test($t, "run_class(" . CLASS_STUDENT_IT . ")");


total($t0, "Total");
