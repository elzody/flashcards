<?php

namespace OCA\Flashcards\Db;

use DateTime;
use JsonSerializable;
use OCP\AppFramework\Db\Entity;

class Deck extends Entity implements JsonSerializable
{
	protected ?string $owner = null;
	protected ?string $name = null;
	protected ?string $emoji = null;
	protected ?DateTime $createdAt = null;

	public function __construct()
	{
		$this->addType('id', 'integer');
		$this->addType('owner', 'string');
		$this->addType('name', 'string');
		$this->addType('emoji', 'string');
		$this->addType('createdAt', 'datetime');
	}

	public function jsonSerialize(): array
	{
		return [
			'id' => $this->id,
			'owner' => $this->owner,
			'name' => $this->name,
			'emoji' => $this->emoji,
			'created_at' => $this->createdAt,
		];
	}
}
