<?php

namespace Parser\Classes;

/**
 * class news
 */
class Admin
{
	/**
	 * @param $login
	 * @param $pass
	 * @return bool
	 */
	public function login($login, $pass)
	{

		$login = DB::esc(trim($login));

		$sql = "select * from `admin` where `login`='{$login}'";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			while ($row = DB::fetch_array($result)) {

				if (password_verify($pass, $row['password'])) {
					// Success!
					$_SESSION['admin'] = md5(SECRET);
					header('Location: login.php');
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	/**
	 *  admin logout
	 */
	public function logout(){
		unset($_SESSION['admin']);
		header('Location: index.php');
	}
}