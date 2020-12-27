<?php

/**
 * class news
 */
class News
{
	public function __construct()
	{
		$this->sources = new Sources();
	}

	/**
	 * news by ID
	 *
	 * @param $obj
	 * @param $id
	 */
	public function get_news_by_id($obj,$id)
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
				$srcData = $this->sources->get_source_by_id($row['source']);
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
				$obj->assign("NEWS_BODY", mb_substr($row['body'], 0, 200, 'UTF-8') . "...");
				$srcData = $this->sources->get_source_by_id($row['source']);
				$obj->assign("NEWS_SRC", $srcData['name']);
				$obj->parse('NEWS_IN', ".news_in");
			}
		}
	}
}