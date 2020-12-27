<?php

//init
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/boot.php');

if (!isset($_SESSION['admin'])) {
	$obj->parse("CONTEXT", ".login");
} else {
	$obj->parse("CONTEXT", ".admin");
}
$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');