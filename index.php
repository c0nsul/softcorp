<?php

//init
require_once("init.php");
use Parser\Classes\News;

$news = new News();

if ($_REQUEST['id'] && (int)$_REQUEST['id'] >0){
	//news by ID
	$news->get_news_by_id($obj, $_REQUEST['id']);
	$obj->parse("CONTEXT", ".news_read");
} else {
	//all news
	$news->get_news_list($obj);
	$obj->parse("CONTEXT", ".news");
}

$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');