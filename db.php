<?php
/**
* PHP PGO Training - to be used during Profile Guided Optimization builds.
*
* Copyright (C) 2016 Intel Corporation
*
* This script is derived from Wordpress - Web publishing software:
*   Copyright 2003-2010 by the contributors
*   WordPress is released under the GPL
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
define('SQL_QUERIES_IT', 40);		/* how many times sql module will run */


define( 'OBJECT_K', 'OBJECT_K' );
define( 'ARRAY_A', 'ARRAY_A' );
define( 'ARRAY_N', 'ARRAY_N' );
define( 'OBJECT', 'OBJECT' );
define( 'object', 'OBJECT' ); // Back compat.

function mysql_register_training(& $functions)
{
	/* if extension is missing goto next bench module */
	if (!extension_loaded("mysqli")) {
		echo "<WARNING> MySQL benchmark module not loaded: mysqli extension is missing\n";
		return -1;
	}
	/* check if a connection to DB is possible */
	$handler = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
	if ( $handler->connect_errno ) {
		$handler = null;
		die("<ERROR> MySQL benchmark module not loaded: Wrong credentials.\n".
			"Make sure the following constants in constants.php are correct: DB_USER, DB_PASSWORD, DB_NAME, DB_HOST.\n");
	} else {
		$success  = @mysqli_select_db($handler, DB_NAME);
		if (!$success) {
			$handler->close();
			die("<ERROR> MySQL benchmark module not loaded: Failed to select database.\n".
				"Make sure you call: </path/to/php>/php init.php\n");
		}
	}
	$handler->close();

	echo "MySQL benchmark module loaded!\n";
	$functions[] = "run_mysql_queries";
}

/**
*	Calls Mysql functions from db.php
*/
function run_mysql_queries() {
	$newDB = new db(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
	if (!$newDB->check_connection())
		die("Connection failed.\n".
			"Make sure the following constants in constants.php are correct: DB_USER, DB_PASSWORD, DB_NAME, DB_HOST.\n".
			"Make sure you call: </path/to/php>/php init.php\n".
			"!!!Attention: restart training process from scratch(make clean && make pgo-train)");
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
class db {

	var $show_errors = false;
	var $last_error = '';	// last error during query
	var $num_queries = 0;	// amount of queries made
	var $rows_affected = 0;	// count of affected rows by previous query
	var $insert_id = 0;		// ID generated for AUTO_INCREMEND column
	var $last_query;		// last query made
	var $last_result;		// result of the last query made
	var $result;
	var $queries;			// queries that were executed
	var $ready = false;		//queries are ready to start executing
	var $tables = array( 'table_one', 'table_two', 'table_three');
	var $reconnect_retries = 2;
	protected $dbuser;
	protected $dbpassword;
	protected $dbname;
	protected $dbhost;
	protected $dbhandle;
	private $has_connected = false;
	private $use_mysqli  = false;
	public $table_one;
	public $table_two;
	public $table_three;

	public function __construct($user, $pass, $dbname, $dbhost) {
		register_shutdown_function( array( $this, '__destruct' ) );

		if (function_exists('mysqli_connect')) {
			$this -> use_mysqli = true;
		}

		$this->dbuser = $user;
		$this->dbpassword = $pass;
		$this->dbname = $dbname;
		$this->dbhost = $dbhost;

		$this->init();
		$this->db_connect();
	}

	public function __destruct() {
		return true;
	}

	public function init() {
		$this->tables = array( 'table_one', 'table_two', 'table_three');
		$this->table_one = 'table_one';
		$this->table_two = 'table_two';
		$this->table_three = 'table_three';

	}
	public function db_connect() {

		$new_link = true;
		$client_flags = 0;

		if( $this->use_mysqli ) {
			// mysqli_real_connect doesn't support the host param including a port or socket
			// like mysql_connect does. This duplicates how mysql_connect detects a port and/or socket file.
			$port = null;
			$socket = null;
			$host = $this->dbhost;
			$port_or_socket = strstr( $host, ':' );
			if ( ! empty( $port_or_socket ) ) {
				$host = substr( $host, 0, strpos( $host, ':' ) );
				$port_or_socket = substr( $port_or_socket, 1 );
				if ( 0 !== strpos( $port_or_socket, '/' ) ) {
					$port = intval( $port_or_socket );
					$maybe_socket = strstr( $port_or_socket, ':' );
					if ( ! empty( $maybe_socket ) ) {
						$socket = substr( $maybe_socket, 1 );
					}
				} else {
					$socket = $port_or_socket;
				}
			}

			//@mysqli_real_connect( $this->dbhandle, $host, $this->dbuser, $this->dbpassword, null, $port, $socket, $client_flags );
			$this->dbhandle = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
			if ( $this->dbhandle->connect_errno ) {
				$this->dbhandle = null;
				die("Connection failed.\n".
				"Make sure the following constants in constants.php are correct: DB_USER, DB_PASSWORD, DB_NAME, DB_HOST.\n".
				"Make sure you call: </path/to/php>/php init.php\n".
				"!!!Attention: restart training process from scratch(make clean && make pgo-train)");return false;

			} elseif ( $this->dbhandle ) {
				//echo "Connected to " . DB_NAME . "!\n";
				$this->has_connected = true;
				$this->ready = true;
				$this->select($this->dbname, $this->dbhandle);
				return true;
			}
		}
		return false;
	}

	public function select($db, $dbh = null) {
		if (is_null($dbh)) {
			$dbh = $this->dbhandle;
		}
		if ($this->use_mysqli) {
			$success  = @mysqli_select_db( $dbh, $db );
		}
		else {
			$success = @mysqli_select_db( $db, $dbh );
		}
		if (!$success) {
			$this->ready = false;
			die("Error: db_select_fail");
			return false;
		}
	}

	public function flush() {
		$this->last_result = array();
		$this->last_query  = null;
		$this->rows_affected = $this->num_rows = 0;
		$this->last_error  = '';

		if ( $this->use_mysqli && $this->result instanceof mysqli_result ) {
			mysqli_free_result( $this->result );
			$this->result = null;

			// Sanity check before using the handle
			if ( empty( $this->dbhandle ) || !( $this->dbhandle instanceof mysqli ) ) {
				return;
			}

			// Clear out any results from a multi-query
			while ( mysqli_more_results( $this->dbhandle ) ) {
				mysqli_next_result( $this->dbhandle );
			}
		} elseif ( is_resource( $this->result ) ) {
			mysql_free_result( $this->result );
		}
	}

	private function _do_query( $query ) {
		if ( defined( 'SAVEQUERIES' ) && SAVEQUERIES ) {
			$this->timer_start();
		}

		if ( $this->use_mysqli ) {
			$this->result = @mysqli_query( $this->dbhandle, $query );
		} else {
			$this->result = @mysql_query( $query, $this->dbhandle );
		}
		$this->num_queries++;
	}

	public function check_connection( $allow_bail = true ) {
		if ( $this->use_mysqli ) {
			if ( @mysqli_ping( $this->dbhandle ) ) {
				return true;
			}
		} else {
			if ( @mysql_ping( $this->dbhandle ) ) {
				return true;
			}
		}

		for ( $tries = 1; $tries <= $this->reconnect_retries; $tries++ ) {
			// On the last try, re-enable warnings. We want to see a single instance of the
			// "unable to connect" message on the bail() screen, if it appears.
			if ( $this->db_connect() ) {
				return true;
			}
			sleep( 1 );
		}
	}

	public function query( $query ) {
		if ( ! $this->ready ) {
			$this->check_current_query = true;
			return false;
		}

		$this->flush();

		// Keep track of the last query for debug..
		$this->last_query = $query;

		$this->_do_query( $query );

		// MySQL server has gone away, try to reconnect
		$mysql_errno = 0;
		if ( ! empty( $this->dbhandle ) ) {
			if ( $this->use_mysqli ) {
				$mysql_errno = mysqli_errno( $this->dbhandle );
			} else {
				$mysql_errno = mysql_errno( $this->dbhandle );
			}
		}

		if ( empty( $this->dbhandle ) || 2006 == $mysql_errno ) {
			if ( $this->check_connection() ) {
				$this->_do_query( $query );
			} else {
				$this->insert_id = 0;
				return false;
			}
		}

		// If there is an error then take note of it..
		if ( $this->use_mysqli ) {
			$this->last_error = mysqli_error( $this->dbhandle );
		} else {
			$this->last_error = mysql_error( $this->dbhandle );
		}

		if ( $this->last_error ) {
			// Clear insert_id on a subsequent failed insert.
			if ( $this->insert_id && preg_match( '/^\s*(insert|replace)\s/i', $query ) )
				$this->insert_id = 0;

			echo $this->dbhandle->error;
			die("\nerror\n");
			return false;
		}

		if ( preg_match( '/^\s*(create|alter|truncate|drop)\s/i', $query ) ) {
			$return_val = $this->result;
		} elseif ( preg_match( '/^\s*(insert|delete|update|replace)\s/i', $query ) ) {
			if ( $this->use_mysqli ) {
				$this->rows_affected = mysqli_affected_rows( $this->dbhandle );
			} else {
				$this->rows_affected = mysql_affected_rows( $this->dbhandle );
			}
			// Take note of the insert_id
			if ( preg_match( '/^\s*(insert|replace)\s/i', $query ) ) {
				if ( $this->use_mysqli ) {
					$this->insert_id = mysqli_insert_id( $this->dbhandle );
				} else {
					$this->insert_id = mysql_insert_id( $this->dbhandle );
				}
			}
			// Return number of rows affected
			$return_val = $this->rows_affected;
		} else {
			$num_rows = 0;
			if ( $this->use_mysqli && $this->result instanceof mysqli_result ) {
				while ( $row = @mysqli_fetch_object( $this->result ) ) {
					$this->last_result[$num_rows] = $row;
					$num_rows++;
				}
			} elseif ( is_resource( $this->result ) ) {
				while ( $row = @mysql_fetch_object( $this->result ) ) {
					$this->last_result[$num_rows] = $row;
					$num_rows++;
				}
			}

			// Log number of rows the query returned
			// and return number of rows selected
			$this->num_rows = $num_rows;
			$return_val     = $num_rows;
		}

		return $return_val;
	}

	public function get_results( $query = null, $output = OBJECT ) {

		if ( $query ) {
			$this->query($query);
		} else {
			return null;
		}

		$new_array = array();
		if ( $output == OBJECT ) {
			// Return an integer-keyed array of row objects
			return $this->last_result;
		} elseif ( $output == OBJECT_K ) {
			// Return an array of row objects with keys from column 1
			// (Duplicates are discarded)
			foreach ( $this->last_result as $row ) {
				$var_by_ref = get_object_vars( $row );
				$key = array_shift( $var_by_ref );
				if ( ! isset( $new_array[ $key ] ) )
					$new_array[ $key ] = $row;
			}
			return $new_array;
		} elseif ( $output == ARRAY_A || $output == ARRAY_N ) {
			// Return an integer-keyed array of...
			if ( $this->last_result ) {
				foreach( (array) $this->last_result as $row ) {
					if ( $output == ARRAY_N ) {
						// ...integer-keyed row arrays
						$new_array[] = array_values( get_object_vars( $row ) );
					} else {
						// ...column name-keyed row arrays
						$new_array[] = get_object_vars( $row );
					}
				}
			}
			return $new_array;
		} elseif ( strtoupper( $output ) === OBJECT ) {
			// Back compat for OBJECT being previously case insensitive.
			return $this->last_result;
		}
		return null;
	}

	public function get_col( $query = null , $x = 0 ) {

		if ( $query ) {
			$this->query( $query );
		}

		$new_array = array();
		// Extract the column values
		for ( $i = 0, $j = count( $this->last_result ); $i < $j; $i++ ) {
			$new_array[$i] = $this->get_var( null, $x, $i );
		}
		return $new_array;
	}

	public function get_row( $query = null, $output = OBJECT, $y = 0 ) {
		if ( $query ) {
			$this->query( $query );
		} else {
			return null;
		}

		if ( !isset( $this->last_result[$y] ) )
			return null;

		if ( $output == OBJECT ) {
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} elseif ( $output == ARRAY_A ) {
			return $this->last_result[$y] ? get_object_vars( $this->last_result[$y] ) : null;
		} elseif ( $output == ARRAY_N ) {
			return $this->last_result[$y] ? array_values( get_object_vars( $this->last_result[$y] ) ) : null;
		} elseif ( strtoupper( $output ) === OBJECT ) {
			// Back compat for OBJECT being previously case insensitive.
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} else {
			$this->print_error( " \$db->get_row(string query, output type, int offset) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N" );
		}
	}

	public function get_var( $query = null, $x = 0, $y = 0 ) {

		if ( $query ) {
			$this->query( $query );
		}

		// Extract var out of cached results based x,y vals
		if ( !empty( $this->last_result[$y] ) ) {
			$values = array_values( get_object_vars( $this->last_result[$y] ) );
		}

		// If there is a value return it else return null
		return ( isset( $values[$x] ) && $values[$x] !== '' ) ? $values[$x] : null;
	}
	function dump_result($query, $output = OBJECT) {
//        echo "\n\t\t-=- DUMP -=-\n";
    	$result = $this->get_results($query, $output);
    	$size = sizeof($result);
    	for( $i = 0 ; $i < $size; $i++){
	    	$row = $result[$i];
	    	$res_str = "";
	    	$num_cols = sizeof($row);
	    	for ($j = 0 ; $j < $num_cols; $j++){
	    		$res_str .= ($row[$j] . "\t");
	    	}
	    	$res_str .= "\n";
//	 		echo $res_str;
	    }
	}

}

function print_row($row) {
	for($i=0; $i<sizeof($row); $i++){
		echo $row[$i] . " ";
	}
	echo "\n";
}

/* SELECT wp_posts.* FROM wp_posts WHERE ID IN (1)
	You can find this query in includes/post.php @5925
*/
function first_query($db_obj) {
	/* table1 - col1 ID */
	$ids = array(0, 1, 2);
	if (!empty($ids)) {
		$some_results = $db_obj->get_results( sprintf("SELECT $db_obj->table_one.* FROM $db_obj->table_one WHERE col1 IN (%s)", join(",", $ids)));
	}
	// TODO Iterate through results
	// also can do different things here like
	// parsing the result or updating something
}

function second_query($db_obj) {
	/* simulates all of select option stuff from WP queries
	table1 - col2 = options->option_name
	table1 - col3 = options->option_value
	table1 - col2 = options->autoload
	*/

	//SELECT option_name, option_value FROM wp_options WHERE autoload = 'yes'
	//option.php @158
	$query =  "SELECT col2, col3 FROM $db_obj->table_one WHERE col4 = 'yes'";
	$db_obj->dump_result($query, ARRAY_N);
	if ( !$something_db = $db_obj->get_results( "SELECT col2, col3 FROM $db_obj->table_one WHERE col4 = 'yes'" ) )
		$something_db = $db_obj->get_results( "SELECT col2, col3 FROM $db_obj->table_one" );
}

function select_simple_WHERE($db_obj, $select_this="col3", $col_name="col2", $name="\"something\"") {
	/* All select option_value from options ...
		option.php @25
	*/
	$row = $db_obj->get_row("SELECT col3 FROM $db_obj->table_one WHERE $col_name = $name LIMIT 1", ARRAY_N);
//	print_row($row);
	if ($row)
		return true;
	return false;
}

function select_INNER_JOIN($db_obj) {
	$taxonomies = array("\"WinnieThePooh\"", "\"Mickey Mouse\"", "\"something\"");
	$ids = range(0, 100, 2);
	$first =  "tr.col2 IN (" . implode(" , ",$taxonomies) . ")";
	$second =  "tr.col1 IN (" . implode(" , ",$ids) . ")";
	$where = array( $first, $second);
	$where = implode( " AND ", $where );
	$select_this = "t.*, tt.*";

	$orderby = "ORDER BY tt.col1";
	$query = "SELECT $select_this FROM $db_obj->table_two AS t INNER JOIN $db_obj->table_one AS tt ON tt.col1 = t.col1 INNER JOIN $db_obj->table_three AS tr ON tr.col1 = tt.col1 WHERE $where $orderby";
	//$results = $db_obj->get_results($query);
	$result = $db_obj->dump_result($query, ARRAY_N);
}

function multiple_WHERE_CLAUSES($db_obj, $select_this="*", $order_by="ORDER BY col1") {

	$query = "SELECT $select_this FROM $db_obj->table_one WHERE $db_obj->table_one.col3=\"something\" AND $db_obj->table_one.col4=\"yes\" $order_by";
	$result = $db_obj->dump_result($query, ARRAY_N);
	$row = $db_obj->get_row($query, ARRAY_N);

}
