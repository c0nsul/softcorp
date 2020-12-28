<?php

//init
require_once("init.php");
use Parser\Classes\Sources;

//auth
if (!isset($_SESSION['admin'])) {
	header('Location: login.php');
}

$src = new Sources();

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