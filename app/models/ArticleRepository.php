<?php

interface ArticleRepository
{

	/**
	 * @param int $id
	 * @return \Article
	 */
	public function findById($id);

	/**
	 * @param $limit
	 * @return \Article[]
	 */
	public function findAll($limit = NULL);

	/**
	 * @param \Article $article
	 * @return \ArticleRepository
	 */
	public function persist(Article $article);

}
