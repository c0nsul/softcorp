<?php

//LIB
define('LIB_DIR', $_SERVER['DOCUMENT_ROOT'] . '/lib/');
define('CONFIG_DIR', $_SERVER['DOCUMENT_ROOT'] . '/config/');
define('CLASS_DIR', $_SERVER['DOCUMENT_ROOT'] . '/class/');


//settings config and constants
require_once(CONFIG_DIR . "config.php");

//other fuctions
require_once(LIB_DIR . 'functions.php');


//Core classes

//TEMPLATE class
require_once(CLASS_DIR . "/core/class.FastTemplate.php"); //tpls
define("TROOT", $_SERVER['DOCUMENT_ROOT'] . '/tpl/');
$obj = new FastTemplate(TROOT);
$obj->define(array(
	"index" => "index.tpl",
	"news" => "news.tpl",
	"news_in" => "news_in.tpl",
	"news_read" => "news_read.tpl",
	"login" => "login.tpl",
	"admin" => "admin.tpl",
));

require_once(CLASS_DIR . "/core/crud.php");
require_once(CLASS_DIR . "/core/phpQuery.php");

//other clases

//DB class
require_once(CLASS_DIR . "db.php");
//fast init
DB::getInstance();

require_once(CLASS_DIR . "news.php");
require_once(CLASS_DIR . "sources.php");
require_once(CLASS_DIR . "admin.php");

