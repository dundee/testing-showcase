<?php

use Nette\Database\Connection;

class HomepagePresenter extends \Nette\Application\UI\Presenter
{

	/** @var \ArticleFacade */
	private $articleFacade;

	public function __construct(ArticleFacade $articleFacade)
	{
		$this->articleFacade = $articleFacade;
	}

	public function renderDefault()
	{
		$articles = $this->articleFacade->getLastArticles();

		$this->template->articles = $articles;
	}

}
