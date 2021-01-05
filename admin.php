<?php

//init
require_once("init.php");

$src = new Parser\Classes\Sources();
$parser = new Parser\Classes\Parser();
$news = new Parser\Classes\News();
$images = new Parser\Classes\Images();

//auth
if (!$admin->auth_check()) {
	header('Location: login.php');
}

//dummy ROUTES
switch ($_REQUEST['route']) {
	case 'del_source':
		if (!empty($_REQUEST['id']) && (int)$_REQUEST['id'] > 0) {
			$src->delete($_REQUEST['id']);
		}
		header('Location: admin.php');
		break;
	case 'create':
		if (!empty($_POST['srcName']) && !empty($_POST['srcUrl'])) {
			$src->create($_POST);
		}
		header('Location: admin.php');
		break;
	case 'parser':
		if (!empty($_REQUEST['id']) && (int)$_REQUEST['id']>0){
			$id = (int)$_REQUEST['id'];
			$parser->init($id);
		}
		header('Location: admin.php');
		break;
	case 'del_news':
		if (!empty($_REQUEST['id']) && (int)$_REQUEST['id']>0){
			$id = (int)$_REQUEST['id'];
			$news->delete($id);
			$images->delete_by_news_id($_REQUEST['del_news']);
		}
		header('Location: index.php');
		break;
	case 'index':
	default:
		$src->get_source_list($obj);
		//light menu
		$obj->assign("ACTIVE_ADMIN", 'active');
		//admin page
		$obj->parse("CONTEXT", ".admin");
		break;
}

$obj->no_strict(); //для отладки
$obj->parse('result', "index");
$obj->FastPrint('result');