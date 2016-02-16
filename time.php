<?php
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