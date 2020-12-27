<?php

//init
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/boot.php');

if (!empty($_REQUEST['logout'])) {
	unset($_SESSION['admin']);
	header('Location: index.php');
}

if (!isset($_SESSION['admin'])) {

	if (!empty($_REQUEST['login']) && !empty($_REQUEST['pass'])) {
		$admin = new Admin();
		$admin->login($_REQUEST['login'], $_REQUEST['pass']);
	}
	$obj->parse("CONTEXT", ".login");
} else {
	$obj->parse("CONTEXT", ".admin");
}


$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');