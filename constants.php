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

/**
 *	Constants used by mysql at authentification 
 */

define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'pgo_train');
define('DB_HOST', 'localhost');

define( 'OBJECT_K', 'OBJECT_K' );
define( 'ARRAY_A', 'ARRAY_A' );
define( 'ARRAY_N', 'ARRAY_N' );
define( 'OBJECT', 'OBJECT' );
define( 'object', 'OBJECT' ); // Back compat.

/** 	
*	How many iterations each type of benchmark
* will run 
*/
define('KEYS_SIZE', 50);			/* number of keys pregenerated in keys.php */
define('DICTIONARY_IT', 300000);	/* number of hash-map iterations */

define('SQL_QUERIES_IT', 40);		/* how many times sql module will run */

define('STRTOTIME_IT', 120);		/* # of strtotime() calls */
define('DATE_IT', 100);				/* # of date() calls */

/** 
*	Constants used in string.php
*/
define('STRING_PREG_REPLACE_IT',15);			/* # of preg_replace() calls */	
define('STRING_PREG_REPLACE_CALLBACK_IT',2);	/* # of preg_replace_callback() calls */
define('STRING_STR_REPLACE_IT', 60);			/* # of str_replace() calls */
define('STRING_SPLIT_IT', 10);					/* # of split() calls */
define('STRING_STRTOLOWER_IT', 2);				/* # of strtolower() calls */
define('STRING_CHECKENCODING_IT', 35);			/* # of mb_check_encoding() calls */
define('STRING_IN_ARRAY_IT', 500);				/* # of in_array() calls */
define('STRING_ECHO_IT', 1);					/* # echo calls */
define('STRING_UNSERIALIZE_IT', 1700);			/* # of unserialize() calls */
define('STRING_SERIALIZE_IT', 500);				/* # of serialize() calls */
define('STRING_TRIM_IT', 15000);				/* # of trim() calls */
define('STRING_CONCAT_IT',1);					/* # string concat - not as side effect*/
define('STRING_MD5_IT', 100);					/* # of md5() calls */
define('STRING_IMPLODE_IT', 1000);				/* # of implode() calls */

/**
*	Constants used in standard_calls.php
*	NOT USED in actual configuration. Modify
*	constants in index.php/run_standard_calls()
*	in order to change the proporions.
*/
define('STANDARD_CALL_IT', 1000);				/* # of different standard calls */
define('INI_SET_IT',100);						/* # of set_it() calls*/
define('FUNC_EXISTS_IT',1000);					/* # of function_exists() calls */
define('FILE_OPS_IT', 10);						/* # of fopen(), fread(), fclose() calls */
define('FILE_EXISTS_IT', 500);					/* # of file_exists() calls */
define('ARRAY_MAP_IT', 4200);					/* # of array_map() calls */
define('ARRAY_KEYS_IT', 20000);					/* # of array_keys() calls */
define('ARRAY_MERGE_IT', 12500);				/* # of array_merge() calls */
define('PREG_MATCH_IT', 10000);					/* # of preg_match() calls */
define('PARSE_URL_IT', 1000);					/* # of parse_url() calls */
define('VERSION_COMPARE_IT', 1200);				/* # of version_compare() calls */

/**
*	Constants used in class.php
*/
define('CLASS_STUDENT_IT', 100);				/* # of classes created */

