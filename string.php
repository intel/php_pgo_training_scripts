<?php
// Wikipedia Uranium page
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

//random number string
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

$s5 = "if (a == b) {
	//do something
	++a;
	} else {
		b +=a;
	}";
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
$split_strings = array();

// does some dummy replacements
function run_string_preg_replace() {
	$strs = $GLOBALS['strings'];
	
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
function run_string_str_replace() {
	$strs = $GLOBALS['strings'];
	
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
			//echo $rez3;
		}

	}
}

function run_string_preg_split() {
	$strs = $GLOBALS['strings'];
	$len = sizeof($strs);
	$GLOBALS['split_strings'] = array();
	for ($i = 0; $i < STRING_SPLIT_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$keywords = preg_split("/[\s,]+/", $strs[$j]);
			if ($j == 0)
				array_push($GLOBALS['split_strings'], $keywords);
			$num_tokens = sizeof($keywords);
			for ($k = 0; $k < $num_tokens; $k++) {
				$chars = preg_split('//', $keywords[$k], -1, PREG_SPLIT_NO_EMPTY);
			}
		}

	}

}
function run_string_strtolower() {
	$strs = $GLOBALS['strings'];
	$len = sizeof($strs);
	for ($i = 0; $i < STRING_STRTOLOWER_IT ;$i++){
		for ($j=0; $j < $len; $j++) {
			$val = strtolower($strs[$j]);
		}
	}
}

function run_string_in_array() {
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

function run_string_check_encoding() {
	$strs = $GLOBALS['strings'];
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
function run_string_echo() {
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

?>