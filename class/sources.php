<?php

/**
 * class news sources

 */
class Sources  extends CRUD
{

	/**
	 * Create
	 *
	 * @param $data
	 */
	public function create($data){

	}

	/**
	 * Read
	 *
	 * @param $id
	 * @return array|false
	 */
	public function read($id){

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
	public function update($id, $data){

	}

	/**
	 * Delete
	 *
	 * @param $id
	 */
	public function delete($id){

	}



	/**
	 *
	 */
	public function get_source_list (){

	}





}