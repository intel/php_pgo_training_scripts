<?php

require_once('constants.php');

//require_once("db.php");
include 'db.php';
include 'time.php';
include 'string.php';
include 'standard_calls.php';
function run_mysql_queries() {
	$newDB = new db(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
	if (!$newDB->check_connection())
		die("Connection closed...");
	else {
		//$newDB->_do_query();
		//$row = $newDB->get_row("SELECT * from table_one", ARRAY_N);
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
		//echo $row[1] . "\n";
		//echo "Queries made: " .  $newDB->num_queries . "\n";
			
	}
}

function run_time() {
	/*	Modify STRTOTIME_IT and DATE_IT to change proportions 
		You will find those in constants.php
	*/
	run_strtotime();
	run_date();
}

function run_string() {
	/*	Modify STRING_*_IT to change proportions 
		You will find those in constants.php
	*/
	run_string_preg_replace();
	run_string_preg_split();
	run_string_strtolower();
	run_string_check_encoding();
	run_string_str_replace();
	run_string_in_array();

}

function run_standard() {
	run_standard_calls();
}
?>
