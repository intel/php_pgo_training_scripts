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
define('STRTOTIME_IT', 120);		/* # of strtotime() calls */
define('DATE_IT', 100);				/* # of date() calls */

function date_register_training(& $functions)
{
	/* if extension is missing goto next bench module */
	if (!extension_loaded("date")) {
		echo "<WARNING> Date benchmark module not loaded: date extension is missing\n";
		return -1;
	}

	echo "Date benchmark module loaded!\n";
	$functions[] = "run_time";
}

/**
*	Calls related to date/time from time.php
*/
function run_time()
{
	run_strtotime();
	run_date();
}

/* *_IT can be found in constants.php. Modify the value
	there if you want to change time proportions*/
function run_strtotime() {
	$months = array("January", "February", "March", "April", "May", "June",
				"July", "August", "September", "October", "November", "December");
	for ($i = 0; $i <= STRTOTIME_IT; $i++) {
		$num = rand();
		$day = $num%28 + 1;
		$month = $num%12;
		$year = 1990 + $num%25;

		$date = $day . " " . $months[$month] . " " . $year;
		$rez = strtotime($date);
		$rez = strtotime("now");
		$rez = strtotime("+10 days");
		$rez = strtotime("-1 day");
		$rez = strtotime("last Sunday");
		$rez = strtotime("next Friday");
		$rez = strtotime("+1 year 28 days 12 hours 13 seconds");

	}

}

function run_date() {
	date_default_timezone_set('America/Los_Angeles');
	for ($i = 0; $i <= DATE_IT; $i++) {
		$num = rand();
		$day = $num%28 + 1;
		$month = $num%12;
		$year = $num%100;
		$f1 = $day . "." . $month . "." . $year;
		$f2 = $day . "-" . $month . "-" . $year;
		$f3 = $day . "/" . $month . "/" . $year;
		$d1 = date("jS F, Y", strtotime($f1));
		$d2 = date("jS F, Y", strtotime($f2));
		$d3 = date("jS F, Y", strtotime($f3));
	}
}
?>
