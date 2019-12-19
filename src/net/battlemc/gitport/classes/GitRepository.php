<?php

namespace net\battlemc\gitport\classes;
class GitRepository
{
	private $name;
	private $author;
	private $repo;
	private $priority;

	public function __construct(array $data)
	{
		$this->name = $data["Name"];
		$this->author = $data["Author"];
		$this->repo = $data["Repo"];
		$this->priority = isset($data["Priority"]) ? $data["Priority"] : 0;
	}

	/**
	 * @return mixed
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return int|mixed
	 */
	public function getPriority()
	{
		return $this->priority;
	}

	/**
	 * @param int|mixed $priority
	 */
	public function setPriority($priority): void
	{
		$this->priority = $priority;
	}

	/**
	 * @return mixed
	 */
	public function getRepo()
	{
		return $this->repo;
	}

	/**
	 * @param GitRepository $repository
	 * @return bool
	 */
	public function hasHigherPriority(GitRepository $repository)
	{
		return $repository->getPriority() > $this->getPriority();
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->getAuthor() . "/" . $this->getRepo();
	}
}