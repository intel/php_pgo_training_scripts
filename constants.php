<?php

define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pgo_train');
define('DB_HOST', 'localhost');
/* how many iterations each type of benchmark
	will run */
define('SQL_QUERIES_IT', 1250);
define('STRTOTIME_IT', 10000);
define('DATE_IT', 10000);
define('STRING_PREG_REPLACE_IT',1000);
define('STRING_STR_REPLACE_IT', 1250);
define('STRING_SPLIT_IT', 40);
define('STRING_STRTOLOWER_IT', 15000);
define('STRING_CHECKENCODING_IT', 2000);
define('STRING_IN_ARRAY_IT', 500);
define('STRING_ECHO_IT', 1000);
define('STANDARD_CALL_IT', 40000);

?>
