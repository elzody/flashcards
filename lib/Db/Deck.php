<?php

namespace OCA\Flashcards\Db;

use DateTime;
use OCP\AppFramework\Db\Entity;

class Deck extends Entity
{
	protected ?string $name = null;
	protected ?string $emoji = null;
	protected ?DateTime $createdAt = null;

	public function __construct()
	{
		$this->addType('id', 'integer');
		$this->addType('name', 'string');
		$this->addType('emoji', 'string');
		$this->addType('createdAt', 'datetime');
	}
}
