<?php

/**
 * @param $url
 * @return bool
 */
function isURL($url)
{
	$pattern = '|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i';
	if (preg_match($pattern, $url) > 0) {
		return true;
	} else {
		return false;
	}
}

/**
 * @param $url
 */
function url_exists($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_NOBODY, true); // set to HEAD request
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // don't output the response
	curl_exec($ch);
	$valid = curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200;
	curl_close($ch);
}

/**
 * @param $url
 * @return int
 */
function url_exists2($url)
{
	if (@file_get_contents($url, 0, null, 0, 1)) {
		return 1;
	} else {
		return 0;
	}
}

/**
 * @param $test_date
 * @return bool
 */
function date_validation($test_date)
{

	//1988-03-14
	$test_arr = explode('-', $test_date);
	if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
		return true;
	} else {
		return false;
	}
}

/**
 * @param $data
 */
function debug($data)
{
	echo '---------------------<br /><pre>';
	print_r($data);
	echo '</pre><br />---------------------';
}

/**
 * @param $string
 * @return string
 */
function rus2translit($string)
{

	$converter = array(

		'а' => 'a',
		'б' => 'b',
		'в' => 'v',

		'г' => 'g',
		'д' => 'd',
		'е' => 'e',

		'ё' => 'e',
		'ж' => 'zh',
		'з' => 'z',

		'и' => 'i',
		'й' => 'y',
		'к' => 'k',

		'л' => 'l',
		'м' => 'm',
		'н' => 'n',

		'о' => 'o',
		'п' => 'p',
		'р' => 'r',

		'с' => 's',
		'т' => 't',
		'у' => 'u',

		'ф' => 'f',
		'х' => 'h',
		'ц' => 'c',

		'ч' => 'ch',
		'ш' => 'sh',
		'щ' => 'sch',

		'ь' => '\'',
		'ы' => 'y',
		'ъ' => '\'',

		'э' => 'e',
		'ю' => 'yu',
		'я' => 'ya',


		'А' => 'A',
		'Б' => 'B',
		'В' => 'V',

		'Г' => 'G',
		'Д' => 'D',
		'Е' => 'E',

		'Ё' => 'E',
		'Ж' => 'Zh',
		'З' => 'Z',

		'И' => 'I',
		'Й' => 'Y',
		'К' => 'K',

		'Л' => 'L',
		'М' => 'M',
		'Н' => 'N',

		'О' => 'O',
		'П' => 'P',
		'Р' => 'R',

		'С' => 'S',
		'Т' => 'T',
		'У' => 'U',

		'Ф' => 'F',
		'Х' => 'H',
		'Ц' => 'C',

		'Ч' => 'Ch',
		'Ш' => 'Sh',
		'Щ' => 'Sch',

		'Ь' => '\'',
		'Ы' => 'Y',
		'Ъ' => '\'',

		'Э' => 'E',
		'Ю' => 'Yu',
		'Я' => 'Ya',

	);

	return strtr($string, $converter);

}

/**
 * @param $str
 * @return string
 */
function str2url($str)
{

	// переводим в транслит

	$str = rus2translit($str);

	// в нижний регистр

	$str = strtolower($str);

	// заменям все ненужное нам на "-"

	$str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);

	// удаляем начальные и конечные '-'

	$str = trim($str, "-");

	return $str;

}

/**
 * @param $data
 */
function die_pre($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	exit;
}
