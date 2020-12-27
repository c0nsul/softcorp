<?php

//init
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/boot.php');

$news = new News();

if ($_REQUEST['id'] && (int)$_REQUEST['id'] >0){
	$news->get_news_by_id($obj, $_REQUEST['id']);
	$obj->parse("CONTEXT", ".news_read");
} else {
	$news->get_news_list($obj);
	$obj->parse("CONTEXT", ".news");
}

$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');