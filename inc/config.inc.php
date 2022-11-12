<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password)
*/
define("DB_HOST", "localhost");
define("DB_NAME", "project");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_PORT", 3306);

// Define error log file and initialize error logging
define("LOGFILE","log/error_log.txt");
ini_set("log_errors", true);
ini_set("error_log", LOGFILE);


define('IMAGES','./upload/');

?>