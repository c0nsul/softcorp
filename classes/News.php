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

	public function __construct()
	{
		$this->sources = new Sources();
	}

	/**
	 * Create
	 *
	 * @param $data
	 */
	public function create($data)
	{

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
	public function get_news_by_id($obj, $id)
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