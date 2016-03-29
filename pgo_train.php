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

require_once('index.php');
require_once('constants.php');
require_once('keys.php');
include 'check_extensions.php';
$dictionary = array();
$references = array();

function add_entry($name, $value) {
  if (isset($references[$name])) {
    $references[$name]++;
  }
  else {
    $references[$name] = 1;
  }
  $dictionary[$name] = $value;
  //count($dictionary);
}

function get_array_keys() {
  return array_keys($GLOBALS['dictionary']);
}

function get_array_values() {
  return array_values($GLOBALS['dictionary']);
}


function fill_dictionary($size) {

  if (!extension_loaded("hash")) {
    echo "Hash is missing!\n";
    return -1;
  }

  $IT = $size / KEYS_SIZE;
  $KEYS = $GLOBALS["KEYS"];
  for($j=0; $j < $IT; $j++)
    for ($i = 0; $i < KEYS_SIZE; $i++) {
      $name = 'KEYS';
      add_entry($KEYS[$i], $i);
      $new = $$name[$i];
      $new = null;
    }
  
  for ($i = 0; $i < ARRAY_KEYS_IT; $i++) {
    $keys = get_array_keys();
  }  
  for ($i = 0; $i < ARRAY_KEYS_IT; $i++) {
    $keys = get_array_values();
  }  

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

