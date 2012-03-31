<?php

class ArticleRepositoryCachedTest extends UnitTestCase
{

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	private $repository;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	private $cache;

	/** @var \ArticleRepositoryCached */
	private $cachedRepository;

	protected function setUp()
	{
		$this->repository = $this->getMockBuilder('ArticleRepository')
			->disableOriginalConstructor()
			->getMock();

		$this->cache = $this->getMockBuilder('Nette\Caching\Cache')
			->disableOriginalConstructor()
			->getMock();

		$this->cachedRepository = new ArticleRepositoryCached($this->repository, $this->cache);
	}

	public function testFindById()
	{
		$article = $this->createArticle();
		$this->repository->expects($this->once())
			->method('findById')
			->with(1)
			->will($this->returnValue($article));

		$this->cache->expects($this->once())
			->method('save')
			->with('article-1', $article);

		$article = $this->cachedRepository->findById(1);
		$this->assertEquals($article, $article);
	}

	public function testFindByIdCached()
	{
		$article = $this->createArticle();

		$this->cache->expects($this->once())
			->method('offsetExists')
			->with('article-1')
			->will($this->returnValue(TRUE));
		$this->cache->expects($this->once())
			->method('offsetGet')
			->with('article-1')
			->will($this->returnValue($article));

		$this->repository->expects($this->never())->method('findById');

		$this->assertEquals($article, $this->cachedRepository->findById(1));
	}

	public function testPersist()
	{
		$article = $this->createArticle();

		$this->repository->expects($this->once())
			->method('persist')
			->with($article);

		$this->cache->expects($this->once())
			->method('save')
			->with('article-1', $article);

		$this->assertInstanceOf('ArticleRepository', $this->cachedRepository->persist($article));
	}

	/**
	 * @return \Article
	 */
	private function createArticle()
	{
		return new Article(1, 'aaa', 'bbb', 3);
	}

}
