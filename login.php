<?php

//init
require_once("init.php");
use Parser\Classes\Admin;

$auth = new Admin();

//logout
if (!empty($_REQUEST['logout'])) {
	$auth->logout();
}

//auth
if (!isset($_SESSION['admin'])) {
	if (!empty($_POST['login']) && !empty($_POST['pass'])) {
		$auth->login($_REQUEST['login'], $_REQUEST['pass']);
	} else {
		$obj->parse("CONTEXT", ".login");
	}
} else {
	header('Location: admin.php');
}

$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');