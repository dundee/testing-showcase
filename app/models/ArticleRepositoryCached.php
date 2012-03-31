<?php

use Nette\Caching\Cache;

class ArticleRepositoryCached implements ArticleRepository
{

	/** @var \ArticleRepository */
	private $repository;

	/** @var \Nette\Caching\Cache */
	private $cache;

	public function __construct(ArticleRepository $repository, Cache $cache)
	{
		$this->repository = $repository;
		$this->cache = $cache;
	}

	/**
	 * @param int $id
	 * @return \Article
	 */
	public function findById($id)
	{
		$key = 'article-' . $id;
		if (isset($this->cache[$key])) {
			return $this->cache[$key];
		}
		$article = $this->repository->findById($id);
		$this->cache->save($key, $article);
		return $article;
	}

	/**
	 * @param int|NULL $limit
	 * @return \Article[]
	 */
	public function findAll($limit = NULL)
	{
		$key = 'articles-' . $limit;
		if (isset($this->cache[$key])) {
			return $this->cache[$key];
		}
		$articles = $this->repository->findAll($limit);
		$this->cache->save($key, $articles);
		return $articles;
	}

	/**
	 * @param \Article $article
	 * @return \ArticleRepository
	 */
	public function persist(Article $article)
	{
		$key = 'article-' . $article->getId();
		$this->repository->persist($article);
		$this->cache->save($key, $article);
		return $this;
	}

}
