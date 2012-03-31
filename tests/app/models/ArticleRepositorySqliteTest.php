<?php

class ArticleRepositorySqliteTest extends IntegrationTestCase
{

	/** @var ArticleRepositorySqlite */
	private $repository;

	protected function setUp()
	{
		$connection = $this->getContainer()->getService('database');
		$connection->query("
			DELETE FROM article WHERE id = 3
		");
		$this->repository = $this->getContainer()->getService('ArticleRepositorySqlite');
	}

	public function testFindById()
	{
		$this->createArticle();

		$article = $this->repository->findById(3);

		$this->assertEquals(3, $article->getId());
		$this->assertEquals('bbb', $article->getName());
		$this->assertEquals('ccc', $article->getContent());
		$this->assertEquals(1, $article->getSeen());
	}

	public function testPersist()
	{
		$this->createArticle();

		$connection = $this->getContainer()->getService('database');

		$article = $this->repository->findById(3);
		$article->setSeen(10);
		$this->repository->persist($article);

		$seen = $connection->query("SELECT seen FROM article WHERE id = 3")->fetchColumn();
		$this->assertEquals(10, $seen);
	}

	private function createArticle()
	{
		$connection = $this->getContainer()->getService('database');
		$connection->query("
			INSERT INTO article (id, name, content, seen)
			VALUES (3, 'bbb', 'ccc', 1)
		");
	}

}
