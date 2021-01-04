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
	 * Create
	 *
	 * @param $data
	 * @throws Exception
	 */
	public function create($data)
	{
		foreach ($data as $datum) {
			if (!empty($datum['image'])) {
				$localImgName = md5($datum['image']) . ".jpg";

				$fileData = $this->read_by_news_id($datum['news_id']);
				if (!empty($fileData['id'])) {
					continue;
				}

				$this->save_image($datum['image'], $localImgName);
				$sql = "INSERT INTO `images` SET `name`='{$localImgName}',`news_id`={$datum['news_id']};";
				DB::query($sql);
			}
		}
	}

	/**
	 * @param $id
	 * @return false|mixed
	 */
	public function read_by_news_id($id)
	{
		$id = (int)$id;
		$sql = "select `name`,`id` from `images` where `news_id`={$id}";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			while ($row = DB::fetch_array($result)) {
				$data['name'] = $row['name'];
				$data['id'] = $row['id'];
				return $data;
			}
		} else {
			return false;
		}
	}

	/**
	 * @param $remote
	 * @param $local
	 * @throws Exception
	 */
	private function save_image($remote, $local)
	{
		$pageCode = $this->crawler->getPage(["url" => $remote]);
		$fp = fopen(STORE . "/{$local}", 'w');
		fwrite($fp, $pageCode['data']['content']);
		fclose($fp);
	}

	/**
	 * Update
	 *
	 * @param $id
	 * @param $data
	 * @throws Exception
	 */
	public function update($id, $data)
	{
		throw new Exception('Not implemented');
	}

	/**
	 * Delete
	 *
	 * @param $id
	 */
	public function delete($id)
	{
		$id = (int)$id;
		$fileData = $this->read($id);

		$sql = "DELETE from `images` where `id`={$id} LIMIT 1";
		DB::query($sql);

		if (file_exists(STORE . "/" . $fileData['name'])) {
			delete(STORE . "/" . $fileData['name']);
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
		$sql = "select `name`,`news_id` from `images` where `id`={$id}";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			$data = [];
			while ($row = DB::fetch_array($result)) {
				$data['name'] = $row['name'];
				$data['news_id'] = $row['news_id'];
			}
			return $data;
		} else {
			return false;
		}
	}

	/**
	 * Delete by news_id
	 *
	 * @param $id
	 */
	public function delete_by_news_id($id)
	{
		$id = (int)$id;
		$fileData = $this->read_by_news_id($id);
		$sql = "DELETE from `images` where `news_id`={$id} LIMIT 1";
		DB::query($sql);

		if (file_exists(STORE . "/" . $fileData['name'])) {
			unlink(STORE . "/" . $fileData['name']);
		}
	}
}
