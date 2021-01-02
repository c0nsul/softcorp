<?php
use Parser\Classes\DB;

//init
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/config.php');


//external libs
require_once(LIB_DIR . "/phpQuery.php");
require_once(LIB_DIR . "/class.FastTemplate.php");

//class autoloader
spl_autoload_register(function ($class) {

	// project-specific namespace prefix
	$prefix = 'Parser\\Classes\\';

	// base directory for the namespace prefix
	$base_dir = __DIR__ . '/classes/';

	// does the class use the namespace prefix?
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}

	// get the relative class name
	$relative_class = substr($class, $len);

	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

	// if the file exists, require it
	if (file_exists($file)) {
		require $file;
	}
});


//TEMPLATE ENGINE INIT
define("TROOT", $_SERVER['DOCUMENT_ROOT'] . '/tpl/');
$obj = new FastTemplate(TROOT);
$obj->define(array(
	"index" => "index.tpl",
	"news" => "news.tpl",
	"news_in" => "news_in.tpl",
	"news_read" => "news_read.tpl",
	"login" => "login.tpl",
	"admin" => "admin.tpl",
	"src_in" => "src_in.tpl",
	"img" => "img.tpl",
));

//DB init
DB::getInstance();
