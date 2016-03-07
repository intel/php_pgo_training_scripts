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