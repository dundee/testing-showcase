<?php

class ArticleFacadeTest extends UnitTestCase
{

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	private $repository;

	/** @var \ArticleFacade */
	private $facade;

	protected function setUp()
	{
		$this->repository = $this->getMockBuilder('ArticleRepository')
			->disableOriginalConstructor()
			->getMock();

		$this->facade = new ArticleFacade($this->repository);
	}

	public function testGetLastArticles()
	{
		$article = $this->createArticle();
		$this->repository->expects($this->once())
			->method('findAll')
			->will($this->returnValue(array($article)));

		$articles = $this->facade->getLastArticles();
		$this->assertCount(1, $articles);
		$this->assertEquals($article, $articles[0]);
	}

	public function testGetArticleById()
	{
		$article = $this->createArticle();
		$this->repository->expects($this->once())
			->method('findById')
			->with(1)
			->will($this->returnValue($article));

		$this->assertEquals($article, $this->facade->getArticleById(1));
	}

	public function testIncreaseSeen()
	{
		$article = $this->createArticle();

		$this->repository->expects($this->once())
			->method('persist')
			->with($article);

		$this->facade->increaseSeen($article);
		$this->assertEquals(4, $article->getSeen());
	}

	/**
	 * @return \Article
	 */
	private function createArticle()
	{
		return new Article(1, 'aaa', 'bbb', 3);
	}

}
