<?php

namespace Parser\Classes;
use Exception;

/**
 * class images
 */
class Images extends CRUD
{

	/**
	 * @var Crawler
	 */
	private $crawler;

	/**
	 * Parser constructor.
	 */
	public function __construct()
	{
		$this->crawler = new Crawler();
	}

	/**
	 * @param $remote
	 * @param $local
	 * @throws Exception
	 */
	private function save_image($remote, $local){
		$pageCode = $this->crawler->getPage(["url" => $remote]);
		$fp = fopen(STORE."/{$local}",'w');
		fwrite($fp, $pageCode['data']['content']);
		fclose($fp);
	}

	/**
	 * Create
	 *
	 * @param $data
	 * @throws Exception
	 */
	public function create($data)
	{
		foreach ($data as $datum){
			if (!empty($datum['image'])){
				$localImgName = md5($datum['image']).".jpg";

				//TODO check is IMAGE EXIST!!!!!!!
				$this->save_image($datum['image'], $localImgName);
				$sql = "INSERT INTO `images` SET `name`='{$localImgName}',`news_id`={$datum['news_id']};";
				DB::query($sql);
			}
		}
	}

	/**
	 * Read
	 *
	 * @param $id
	 * @return false|mixed
	 */
	public function read($id)
	{
		$id = (int)$id;
		$sql = "select `name` from `images` where `news_id`={$id}";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			while ($row = DB::fetch_array($result)) {
				return $row['name'];
			}
		} else {
			return false;
		}
	}


	/**
	 * Update
	 *
	 * @param $id
	 * @param $data
	 */
	public function update($id, $data)
	{

	}

	/**
	 * Delete
	 *
	 * @param $id
	 */
	public function delete($id)
	{

	}

}
