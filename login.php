<?php

namespace Parser\Classes;

/**
 * @var obj $obj
 * @var obj $admin
 */

//init
require_once("init.php");

//auth
if ($admin->auth_check()) {
	header('Location: admin.php');
} else {
	if (!empty($_POST['login']) && !empty($_POST['pass'])) {
		$admin->login($_REQUEST['login'], $_REQUEST['pass']);
	} else {
		$obj->parse("CONTEXT", ".login");
	}
}

$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');