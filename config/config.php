<?php

//FOLDERS
define('CONFIG_DIR', $_SERVER['DOCUMENT_ROOT'] . '/config/');
define('CLASS_DIR', $_SERVER['DOCUMENT_ROOT'] . '/classes/');
define('LIB_DIR', $_SERVER['DOCUMENT_ROOT'] . '/lib/');

//debug
define('DEBUG', false);

//debug
if (DEBUG == true || (isset($_REQUEST['debug']) && $_REQUEST['debug'] == 1)) {

	echo "<pre>DEBUG MODE ON";
	echo "</pre>";
} else {
	error_reporting('E_ALL');
	error_reporting('E_ALL & ~E_DEPRECATED');
}

set_time_limit(60);

//session
session_start();
ini_set('error_log', 'error_log.txt');
ini_set('memory_limit', '256M');
define('_SET_PAGING_LIMIT', 10);
//auth
define("SECRET", "superpass");
define("STORE", "/store");


if (strstr($_SERVER['HTTP_HOST'], "softcorp.")) {

	//LIVE BD
	define("DATABASE", "");
	define("DB_USER", "");
	define("DB_PASSWORD", "");
	define("HOST", "localhost");

} else {

	//local DB
	define("DATABASE", "softcorp_tz_parser");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
	define("HOST", "localhost");
}