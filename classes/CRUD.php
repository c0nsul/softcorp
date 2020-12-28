<?php

namespace Parser\Classes;

/**
 *  abstract class CRUD
 */
abstract class CRUD
{
	/**
	 * @param $data
	 * @return mixed
	 */
	abstract public function create($data);

	/**
	 * @param $id
	 * @return mixed
	 */
	abstract public function read($id);

	/**
	 * @param $id
	 * @param $data
	 * @return mixed
	 */
	abstract public function update($id, $data);

	/**
	 * @param $id
	 * @return mixed
	 */
	abstract public function delete($id);
}
