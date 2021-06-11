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

function printExistingDB() {
    echo "\n\t\t-=- Existing Databases -=-\n";
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect);
    }

    $command = "SHOW DATABASES";
	$result = $conn->query($command);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo $row["Database"] . "\n";
		}
	} else {
		echo "0 available databases\n";
	}
	$conn->close();
}

function insert_random_stuff($conn) {
    $yes_no = array("\"yes\"", "\"no\"");
    $names = array("\"WinnieThePooh\"" , "\"Mickey Mouse\"", "\"something\"", "\"random_name\"", "\"YetAnotherName\"");
    $values = array("\"value 1\"", "\"value 2\"", "\"limitless value\"", "\"minus value\"", "\"something\"");

    // for table 1
    for ($i=0; $i < 100; $i++) {
        $rand_1 = rand(0, $i);
        $rand_2 = rand(0, $i);
        $rand_3 = rand(0, $i);
        $command = "INSERT INTO table_one (col2, col3, col4) VALUES (" . $names[($i+$rand_1)%5] . "," . $values[($i+$rand_2)%5] . "," . $yes_no[($i+$rand_3)%2] .")";
        if ($conn->query($command) == FALSE) {
            die("Error populating tables");
        }
    }
    for ($i=0; $i < 15; $i++) {
        $rand_1 = rand(0, $i);
        $rand_2 = rand(0, $i);
        $rand_3 = rand(0, $i);
        $command = "INSERT INTO table_two (col2, col3) VALUES (" . $names[($i+$rand_1)%5] . "," . $values[($i+$rand_2)%5] . ")";
        if ($conn->query($command) == FALSE) {
            die("Error populating tables");
        }
    }
    for ($i=0; $i < 1000; $i++) {
        $rand_1 = rand(0, $i);
        $rand_2 = rand(0, $i);
        $rand_3 = rand(0, $i);
        $command = "INSERT INTO table_three (col2, col3) VALUES (" . $names[($i+$rand_1)%5] . "," . $values[($i+$rand_2)%5] . ")";
        if ($conn->query($command) == FALSE) {
            die("Error populating tables");
        }
    }
}

function initDB() {

    echo "\n\t\t-=- init Database(s) -=-\n";
    // Connect to mysql
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect);
    }

    if ($conn->select_db(DB_NAME)) {
      	$command = "DROP DATABASE " . DB_NAME ;
      	if ($conn->query($command) == TRUE) {
           	echo "Database " . DB_NAME . " succesfully dropped\n";
       	} else {
   	    	echo "Error dropping database " . DB_NAME . ": " . $conn->error . "\n";
        }
    }

    // Create database
    $command = "CREATE DATABASE " . DB_NAME;
    if ($conn->query($command) == TRUE) {
        echo "Database " . DB_NAME . " created succesfully\n";
    } else {
        echo "Error creating database: " . DB_NAME . $conn->error . "\n";
    }
    $command = "USE " . DB_NAME;

    $conn->query($command);
    /* drop tables if exitst */
    $conn->query("DROP TABLE table_one");
    $conn->query("DROP TABLE table_two");
    $conn->query("DROP TABLE table_three");
    /* create required tables */
    $command = "
    CREATE TABLE IF NOT EXISTS table_one (
    col1 bigint(5) NOT NULL AUTO_INCREMENT,
    col2 varchar(50) DEFAULT NULL,
    install_date DATE DEFAULT NULL,
    col3 varchar(64) DEFAULT NULL,
    col4 varchar(250) DEFAULT NULL,
    PRIMARY KEY(col1)
    )";
    $conn->query($command);

    $command = "
    CREATE TABLE IF NOT EXISTS table_two (
    col1 bigint(5) NOT NULL AUTO_INCREMENT,
    col2 varchar(50) DEFAULT NULL,
    col3 varchar(64) DEFAULT NULL,
    PRIMARY KEY(col1)
    )";

    $conn->query($command);
    $command = "
    CREATE TABLE IF NOT EXISTS table_three (
    col1 bigint(5) NOT NULL AUTO_INCREMENT,
    col2 varchar(50) DEFAULT NULL,
    col3 varchar(64) DEFAULT NULL,
    PRIMARY KEY(col1)
    )";
    if ($conn->query($command) == TRUE) {
        echo "Created tables in " . DB_NAME . "\n";
    } else {
        echo "Error creating tables in : " . DB_NAME . $conn->error . "\n";
    }
    insert_random_stuff($conn);
    $conn->close();
}

mysqli_report(MYSQLI_REPORT_OFF);
initDB();
printExistingDB();
?>
