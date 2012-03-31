<?php

class ArticleFacade
{

	/** @var \ArticleRepository */
	private $repository;

	public function __construct(ArticleRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @return \Article[]
	 */
	public function getLastArticles()
	{
		return $this->repository->findAll();
	}

	/**
	 * @param int $id
	 * @return \Article
	 */
	public function getArticleById($id)
	{
		return $this->repository->findById($id);
	}

	/**
	 * @param \Article $article
	 * @return \ArticleService
	 */
	public function increaseSeen(Article $article)
	{
		$article->setSeen($article->getSeen() + 1);
		$this->repository->persist($article);
		return $this;
	}

}
