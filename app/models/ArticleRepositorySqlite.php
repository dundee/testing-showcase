<?php

use Nette\Database\Connection;

class ArticleRepositorySqlite extends \Nette\Database\Table\Selection implements ArticleRepository
{

	public function __construct(Connection $connection)
	{
		parent::__construct('article', $connection);
	}

	/**
	 * @param int $id
	 * @return Article
	 */
	public function findById($id)
	{
		$row = $this->get($id);
		$article = new Article(
			$row->id,
			$row->name,
			$row->content,
			$row->seen
		);
		return $article;
	}

	/**
	 * @param null $limit
	 * @return \Article[]
	 */
	public function findAll($limit = NULL)
	{
		$rows = $this->order('name')->limit($limit);
		$articles = array();
		foreach ($rows as $row) {
			$article = new Article(
				$row->id,
				$row->name,
				$row->content,
				$row->seen
			);
			$articles[] = $article;
		}
		return $articles;
	}

	/**
	 * @param Article $article
	 * @return \ArticleRepository
	 */
	public function persist(Article $article)
	{
		$this->where(array('id' => $article->getId()))->update(array(
			'seen' => $article->getSeen(),
		));
		return $this;
	}

}
