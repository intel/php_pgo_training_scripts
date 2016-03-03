<?php

define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pgo_train');
define('DB_HOST', 'localhost');
define('KEYS_SIZE', 50);

/* how many iterations each type of benchmark
	will run */
define('DICTIONARY_IT', 300000);

define('SQL_QUERIES_IT', 40);

define('STRTOTIME_IT', 120);
define('DATE_IT', 100);

define('STRING_PREG_REPLACE_IT',15);
define('STRING_PREG_REPLACE_CALLBACK_IT',2);
define('STRING_STR_REPLACE_IT', 60);
define('STRING_SPLIT_IT', 10);
define('STRING_STRTOLOWER_IT', 2);
define('STRING_CHECKENCODING_IT', 35);
define('STRING_IN_ARRAY_IT', 500);
define('STRING_ECHO_IT', 1);
define('STRING_UNSERIALIZE_IT', 1700);
define('STRING_SERIALIZE_IT', 500);
define('STRING_TRIM_IT', 15000);
define('STRING_CONCAT_IT',1);
define('STRING_MD5_IT', 100);
define('STRING_IMPLODE_IT', 1000);

define('STANDARD_CALL_IT', 1000);
define('INI_SET_IT',100);
define('FUNC_EXISTS_IT',1000);
define('FILE_OPS_IT', 10);
define('FILE_EXISTS_IT', 500);
define('ARRAY_MAP_IT', 4200);
define('ARRAY_KEYS_IT', 20000);
define('ARRAY_MERGE_IT', 12500);
define('PREG_MATCH_IT', 10000);
define('PARSE_URL_IT', 1000);
define('VERSION_COMPARE_IT', 1200);

define('CLASS_STUDENT_IT', 100);
?>
