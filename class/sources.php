<?php

/**
 * class news sources

 */
class Sources
{
	/**
	 *
	 */
	public function get_source_list (){

	}


	public function get_source_by_id ($id){

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



}