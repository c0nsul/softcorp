<?php

namespace Parser\Classes;

use Exception;
use phpQuery;


/**
 * class parser
 */
class Parser
{
	const RBC_WEBSITE = 'RBC';

	/**
	 * @var Sources
	 */
	private $sources;

	/**
	 * @var Crawler
	 */
	private $crawler;

	/**
	 * @var News
	 */
	private $news;

	/**
	 * @var
	 */
	private $images;

	/**
	 * Parser constructor.
	 */
	public function __construct()
	{
		$this->sources = new Sources();
		$this->crawler = new Crawler();
		$this->news = new News();
		$this->images = new Images();
	}

	/**
	 * select parser type
	 *
	 * @param $id
	 * @return false
	 */
	public function init_parsing($id)
	{
		$id = (int)$id;
		$parsingData = $this->sources->read($id);

		try {
			$pageCode = $this->crawler->getPage(["url" => $parsingData['parse_url']]);
			$pageCode['source_id'] = $id;

			/*
			if (!empty($pageCode['error'])) {
				return $pageCode['error'];
			}
			*/

			switch ($parsingData['name']) {
				case self::RBC_WEBSITE:
					$this->rbk_parse($pageCode);
					break;
				case 'other':
					//TODO implementing other website
					throw new Exception('Not implemented');
				default:
					return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * @param $data
	 * @return bool
	 * @throws Exception
	 */
	public function rbk_parse($data)
	{
		//phase 1
		$linksArray = $this->parse_rbk_short_feed($data);

		//phase 2
		$fullNewsArray = $this->parse_ever_feed_rbk($linksArray);

		//phase 3
		$fullNewsArrayUpdated = $this->news->create($fullNewsArray);

		//phase 4
		$this->images->create($fullNewsArrayUpdated);
		return true;
	}

	/**
	 * @param $data
	 * @return array
	 */
	public function parse_rbk_short_feed($data)
	{
		$document = phpQuery::newDocument($data['data']['content']);
		$dataRow = $document->find('div.js-news-feed-list > a.news-feed__item');
		$i = 0;
		$linksArray = [];
		foreach ($dataRow as $item) {

			$linksArray[$i]['url'] = pq($item)->attr('href');
			if (strstr($linksArray[$i]['url'], 'traffic')) {
				//AD link is not RBC news - removed
				unset($linksArray[$i]);
				continue;
			}
			$linksArray[$i]['external_id'] = pq($item)->attr('id');
			$linksArray[$i]['topic'] = pq($item)->html();
			$linksArray[$i]['source_id'] = $data['source_id'];
			$i++;

			if ($i == 15) {
				break;
			}
		}
		return $linksArray;
	}

	/**
	 * @param $linksArray
	 * @return array
	 */
	public function parse_ever_feed_rbk($linksArray)
	{
		$newLink = [];
		foreach ($linksArray as $link) {
			try {

				$pageCode = $this->crawler->getPage(["url" => $link['url']]);

				if (!empty($pageCode['error'])) {
					continue;
				}

				$document = phpQuery::newDocument($pageCode['data']['content']);
				$dataRow = $document->find('div.article__text');

				//main article IMG
				$imgRow = $dataRow->find('img.article__main-image__image');
				$link['image'] = pq($imgRow)->attr('src');

				//rm pro from feed
				$dataRow->find('div.pro-anons')->remove();
				//rm banner AD
				$dataRow->find('div.banner')->remove();
				//rm ticker
				$dataRow->find('div.article__ticker')->remove();
				//rm inline AD
				$dataRow->find('div.article__inline-item')->remove();
				//rm main photo
				$dataRow->find('div.article__main-image')->remove();
				$dataRow->find('div.article__main-image__author')->remove();
				//final data
				$link['body'] = strip_tags(pq($dataRow)->html());
				$topicFix = explode('</span>', $link['topic']);

				$link['topic'] = trim(strip_tags($topicFix[0]));
				$newLink[] = $link;

			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		return $newLink;
	}
}