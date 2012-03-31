<?php

class ArticleTest extends UnitTestCase
{

	public function testConstruction()
	{
		$article = new Article(1, 'a', 'b', 3);
		$this->assertInstanceOf('Article', $article);
	}

	public function testGetters()
	{
		$article = new Article(1, 'a', 'b', 3);
		$this->assertEquals(1, $article->getId());
		$this->assertEquals('a', $article->getName());
		$this->assertEquals('b', $article->getContent());
		$this->assertEquals(3, $article->getSeen());
	}

	public function testSeen()
	{
		$article = new Article(1, 'a', 'b', 3);
		$article->setSeen(5);

		$this->assertEquals(5, $article->getSeen());
	}

}
