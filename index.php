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
include 'dictionary.php';

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

$functions = array();
hash_register_training($functions);
mysql_register_training($functions);
date_register_training($functions);
string_register_training($functions);
standard_register_training($functions);
class_register_training($functions);
$t0 = $t = start_test();
echo "\n--------------------------------\n";
echo "-   Benchmark timing results   -\n";
foreach ($functions as &$fname) {
	echo "--------------------------------\n";
	for($i = 0 ; $i < 4; $i++) {
		$fname();
		$t = end_test($t, ($i + 1) . "." . $fname);
	}

}
total($t0, "Total");
