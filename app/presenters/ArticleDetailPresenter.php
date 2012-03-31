<?php

use Nette\Database\Connection;

class ArticleDetailPresenter extends \Nette\Application\UI\Presenter
{

	/** @var \ArticleFacade */
	private $articleFacade;

	public function __construct(ArticleFacade $articleFacade)
	{
		$this->articleFacade = $articleFacade;
	}

	public function renderDefault($id)
	{
		$article = $this->articleFacade->getArticleById($id);

		$this->articleFacade->increaseSeen($article);

		$this->template->article = $article;
	}

}
