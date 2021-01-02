<?php

namespace Parser\Classes;


/**
 * class images
 */
class Images extends CRUD
{
	/**
	 * @param $remote
	 * @param $local
	 */
	private function save_image($remote, $local){
		$ch = curl_init($remote);
		$fp = fopen(STORE."/{$local}", 'wb');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		if (curl_errno($ch)) {
			throw new Exception('Error with curl response: '.curl_error($ch));
		}
		curl_close($ch);
		fclose($fp);
	}

	/**
	 * Create
	 *
	 * @param $data
	 */
	public function create($data)
	{
		foreach ($data as $datum){
			if (!empty($datum['image'])){
				$localImgName = md5($datum['image']);
				$this->save_image($datum['image'], "{$localImgName}.jpg");
				$sql = "INSERT INTO `images` SET `name`='{$localImgName}',`news_id`={$datum['id']};";
				DB::query($sql);
			}
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

}
