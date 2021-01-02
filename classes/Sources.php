<?php
namespace Parser\Classes;

/**
 * class news sources
 */
class Sources extends CRUD
{

	/**
	 * Create
	 *
	 * @param $data
	 */
	public function create($data)
	{
		$name = DB::esc(trim($data['srcName']));
		$url = DB::esc(trim($data['srcUrl']));
		$sql = "INSERT INTO `sources` SET `name`='{$name}',`parse_url`='{$url}';";
		DB::query($sql);
	}

	/**
	 * Read
	 *
	 * @param $id
	 * @return array|false
	 */
	public function read($id)
	{
		$id = (int)$id;
		$sql = "select * from `sources` where `id`={$id}";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			while ($row = DB::fetch_array($result)) {
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['parse_url'] = $row['parse_url'];
			}
			return $data;
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
		$sql = "DELETE from `sources` where `id`={$id}";
		DB::query($sql);
	}


	/**
	 *
	 */
	public function get_source_list($obj)
	{
		$sql = "select * from `sources` limit 100";
		$result = DB::query($sql);
		if (DB::num_rows($result) > 0) {
			$n = 1;
			while ($row = DB::fetch_array($result)) {
				$obj->assign("SRC_N", $n);
				$obj->assign("SRC_ID", $row['id']);
				$obj->assign("SRC_NAME", $row['name']);
				$obj->assign("SRC_URL", $row['parse_url']);
				$obj->parse('SRC_IN', ".src_in");
				$n++;
			}
		} else {
			return false;
		}
	}


}