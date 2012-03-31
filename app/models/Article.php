<?php

class Article extends \Nette\Object
{

	/** @var int */
	private $id;

	/** @var string */
	private $name;

	/** @var string */
	private $content;

	/** @var int */
	private $seen;

	/**
	 * @param int $id
	 * @param string $name
	 * @param string $content
	 * @param int $seen
	 */
	public function __construct($id, $name, $content, $seen)
	{
		$this->id = $id;
		$this->name = $name;
		$this->content = $content;
		$this->seen = $seen;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @return int
	 */
	public function getSeen()
	{
		return $this->seen;
	}

	/**
	 * @param $seen
	 * @return \Article
	 */
	public function setSeen($seen)
	{
		$this->seen = (int) $seen;
		return $this;
	}

}
