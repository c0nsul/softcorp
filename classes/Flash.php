<?php

namespace Parser\Classes;

class Flash
{
	/**
	 * Success
	 *
	 * @param $obj
	 */
	public function success($obj)
	{
		$obj->assign("ALERT_TEXT", "Операция выполнена успешно!");
		$obj->parse("NEWS_ALERT", ".alert_success");
		unset($_SESSION['alert']);
	}

	/**
	 * Fail
	 *
	 * @param $obj
	 */
	public function fail($obj)
	{
		$obj->assign("ALERT_TEXT", "Ошибка!");
		$obj->parse("NEWS_ALERT", ".alert");
		unset($_SESSION['alert']);
	}
}