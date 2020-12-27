<?php

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
					header('Location: admin.php');
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
}