<?php
namespace Parser\Classes;

//init
require_once("init.php");
/**
 * @var obj $obj
 */

$news = new News();
$flash = new Flash();

(!empty($_SESSION['alert']) && $_SESSION['alert'] == 'success') ? $flash->success($obj) : null;
(!empty($_SESSION['alert']) && $_SESSION['alert'] == 'fail') ? $flash->fail($obj) : null;


if (!empty($_REQUEST['id']) && (int)$_REQUEST['id'] >0){
	//news by ID
	$news->get_news_object_by_id($obj, $_REQUEST['id']);
	$obj->parse("CONTEXT", ".news_read");
} else {
	//all news
	$news->get_news_list($obj);
	$obj->parse("CONTEXT", ".news");
}


//light menu
$obj->assign("ACTIVE_NEWS", 'active');

$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');