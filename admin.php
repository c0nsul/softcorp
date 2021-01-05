<?php
namespace Parser\Classes;

//init
require_once("init.php");
/**
 * @var obj $obj
 * @var obj $admin
 */


$src = new Sources();
$parser = new Parser();
$news = new News();
$images = new Images();
$flash = new Flash();

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
		$_SESSION['alert'] = 'success';
		header('Location: admin.php');
		break;
	case 'create':
		if (!empty($_POST['srcName']) && !empty($_POST['srcUrl'])) {
			$src->create($_POST);
		}
		$_SESSION['alert'] = 'success';
		header('Location: admin.php');
		break;
	case 'parser':
		if (!empty($_REQUEST['id']) && (int)$_REQUEST['id']>0){
			$id = (int)$_REQUEST['id'];
			$parser->init($id);
		}
		$_SESSION['alert'] = 'success';
		header('Location: admin.php');
		break;
	case 'del_news':
		if (!empty($_REQUEST['id']) && (int)$_REQUEST['id']>0){
			$id = (int)$_REQUEST['id'];
			$news->delete($id);
			$images->delete_by_news_id($_REQUEST['del_news']);
		}
		$_SESSION['alert'] = 'success';
		header('Location: index.php');
		break;
	case 'index':
	default:
		(!empty($_SESSION['alert']) && $_SESSION['alert'] == 'success') ? $flash->success($obj) : null;
		(!empty($_SESSION['alert']) && $_SESSION['alert'] == 'fail') ? $flash->fail($obj) : null;

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