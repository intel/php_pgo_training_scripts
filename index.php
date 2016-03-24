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

require_once('constants.php');
include 'db.php';
include 'time.php';
include 'string.php';
include 'standard_calls.php';
include 'class.php';


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

/** Standard php calls. Use variables defined below to
*	control the proportions of different standard calls.
*/
function run_standard() {
	$STANDARD_CALL_IT = 10000;
	$INI_SET_IT = 100;
	$FUNC_EXISTS_IT = 1000;
	$FILE_OPS_IT = 10;
	$FILE_EXISTS_IT = 500;
	$ARRAY_MAP_IT = 4200;
	$VERSION_COMPARE_IT = 1200;
	$ARRAY_MERGE_IT = 12500;
	$PREG_MATCH_IT  = 10000;
	$PARSE_URL_IT = 1000;

	if (!extension_loaded("standard")) {
		echo "Standard is missing!\n";
		return -1;
	}
	run_standard_calls($STANDARD_CALL_IT);
	run_array_map($ARRAY_MAP_IT);
	run_array_merge($ARRAY_MERGE_IT);
	run_preg_match($PREG_MATCH_IT);
	run_parse_url($PARSE_URL_IT);
	run_version_compare($VERSION_COMPARE_IT);
	run_file_exists($FILE_EXISTS_IT);
	run_file_operations($FILE_OPS_IT);
	run_ini_set($INI_SET_IT);
}
function run_class() {
	run_create_classes();
}
function run_hash() {
	run_hash_array();
}
