<?php

//init
require_once("init.php");
use Parser\Classes\Sources;
use Parser\Classes\Parser;

//auth
if (!isset($_SESSION['admin'])) {
	header('Location: login.php');
}

$src = new Sources();
$parser = new Parser();

//init parsing
if (!empty($_REQUEST['start_id']) && (int)$_REQUEST['start_id']>0){
	$parser->init_parsing($_REQUEST['start_id']);
	header('Location: admin.php');
}

//create
if (!empty($_POST['srcName']) && !empty($_POST['srcUrl'])) {
	$src->create($_POST);
	header('Location: admin.php');
}


//delete
if (!empty($_REQUEST['del_id']) && (int)$_REQUEST['del_id'] > 0) {
	$src->delete($_REQUEST['del_id']);
	header('Location: admin.php');
}


$src->get_source_list($obj);

//admin page
$obj->parse("CONTEXT", ".admin");

$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');