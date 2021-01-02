<?php

namespace Parser\Classes;

/**
 * class news
 */
class News extends CRUD
{
	public $startNewsPreviewString = 0;
	public $maxNewsPreview = 200;

	/**
	 * @var Sources
	 */
	private $sources;

	/**
	 * @var
	 */
	private $images;

	/**
	 * News constructor.
	 */
	public function __construct()
	{
		$this->sources = new Sources();
		$this->images = new Images();
	}

	/**
	 * Create
	 *
	 * @param $data
	 * * @return array
	 */
	public function create($data)
	{
		$createdArray = [];
		foreach ($data as $item) {
			$topic = DB::esc($item['topic']);
			$body = DB::esc($item['body']);
			$external_id = DB::esc($item['external_id']);
			$time = time();

			$checkResult = $this->check_existing_news($item['external_id']);
			if ($checkResult) {
				//news already exist in DB
				continue;
			}

			$sql = "INSERT INTO `news` SET `topic`='{$topic}',`body`='{$body}',`source`={$item['source_id']},`external_id`='{$external_id}',`date`={$time}";
			DB::query($sql);
			$item['news_id'] = DB::insert_id();
			$createdArray[] = $item;
		}
		return $createdArray;
	}

	/**
	 * @param $external_id
	 * @return bool
	 */
	public function check_existing_news($external_id)
	{
		$sql = "select `id` from `news` where `external_id`='{$external_id}'";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Read
	 *
	 * @param $id
	 */
	public function read($id)
	{

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

	/**
	 * news by ID
	 *
	 * @param $obj
	 * @param $id
	 */
	public function get_news_object_by_id($obj, $id)
	{
		$id = (int)$id;
		$sql = "select * from `news` where `id`={$id}";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			while ($row = DB::fetch_array($result)) {
				$obj->assign("NEWS_ID", $row['id']);
				$obj->assign("NEWS_TIME", date("H:i", $row['date']));
				$obj->assign("NEWS_DATE", date("d.m.Y", $row['date']));
				$obj->assign("NEWS_TOPIC", $row['topic']);
				$obj->assign("NEWS_BODY", $row['body']);

				$newsImg = $this->images->read($row['id']);
				if ($newsImg) {
					$obj->assign("NEWS_IMAGE", $newsImg);
					$obj->parse('NEWS_IMG', ".img");
				}
				$srcData = $this->sources->read($row['source']);
				$obj->assign("NEWS_SRC", $srcData['name']);
			}
		}
	}

	/**
	 * news feed
	 *
	 * @param $obj
	 */
	public function get_news_list($obj)
	{
		$sql = "select * from `news` order by id desc limit 100";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			while ($row = DB::fetch_array($result)) {
				$obj->assign("NEWS_ID", $row['id']);
				$obj->assign("NEWS_TIME", date("H:i", $row['date']));
				$obj->assign("NEWS_DATE", date("d.m.Y", $row['date']));
				$obj->assign("NEWS_TOPIC", $row['topic']);
				$obj->assign("NEWS_BODY",
					mb_substr($row['body'], $this->startNewsPreviewString, $this->maxNewsPreview, 'UTF-8') . "...");
				$srcData = $this->sources->read($row['source']);
				$obj->assign("NEWS_SRC", $srcData['name']);
				$obj->parse('NEWS_IN', ".news_in");
			}
		}
	}
}