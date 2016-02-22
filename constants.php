<?php

define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pgo_train');
define('DB_HOST', 'localhost');
define('KEYS_SIZE', 1000);

/* how many iterations each type of benchmark
	will run */
define('DICTIONARY_IT', 5000000);

define('SQL_QUERIES_IT', 400);

define('STRTOTIME_IT', 1200);
define('DATE_IT', 1000);

define('STRING_PREG_REPLACE_IT',150);
define('STRING_PREG_REPLACE_CALLBACK_IT',20);
define('STRING_STR_REPLACE_IT', 600);
define('STRING_SPLIT_IT', 100);
define('STRING_STRTOLOWER_IT', 20);
define('STRING_CHECKENCODING_IT', 350);
define('STRING_IN_ARRAY_IT', 5000);
define('STRING_ECHO_IT', 1);
define('STRING_UNSERIALIZE_IT', 17000);
define('STRING_SERIALIZE_IT', 5000);
define('STRING_TRIM_IT', 150000);
define('STRING_CONCAT_IT',1);
define('STRING_MD5_IT', 1000);
define('STRING_IMPLODE_IT', 10000);

define('STANDARD_CALL_IT', 1);
define('FUNC_EXISTS_IT',10000);
define('FILE_OPS_IT', 100);
define('FILE_EXISTS_IT', 5000);
define('ARRAY_MAP_IT', 42000);
define('ARRAY_KEYS_IT', 200000);
define('ARRAY_MERGE_IT', 125000);
define('PREG_MATCH_IT', 100000);
define('PARSE_URL_IT', 10000);
define('VERSION_COMPARE_IT', 12000);

define('CLASS_STUDENT_IT', 1000);
?>
