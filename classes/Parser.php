<?php

namespace Parser\Classes;

/**
 *  abstract class Parser
 */
class Parser
{
	const RBC_WEBSITE = 'RBC';

	/**
	 * @var Sources
	 */
	private $sources;

	/**
	 * @var ParserRbcJson
	 */
	private $parserRbc;

	/**
	 * Parser constructor.
	 */
	public function __construct()
	{
		$this->sources = new Sources();
		$this->parserRbc = new ParserRbcJson();
	}

	public function init($id)
	{
		$id = (int)$id;
		$sourceData = $this->sources->read($id);

		switch ($sourceData['name']) {
			case self::RBC_WEBSITE:
				$this->parserRbc->init($sourceData);
				break;
			case 'other':
				//implementing other website parser
				throw new Exception('Not implemented');
			default:
				return false;
		}

	}
}
