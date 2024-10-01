<?php

namespace OCA\Flashcards\Service;

use OCA\Flashcards\Db\Deck;
use OCA\Flashcards\Db\DeckMapper;

class DeckService
{
	public function __construct(private DeckMapper $mapper)
	{
	}

	public function findAll(?string $userId = null)
	{
		return $this->mapper->findAll($userId);
	}

	public function create(string $name, ?string $emoji)
	{
		$deck = new Deck();
		$deck->setName($name);
		$deck->setEmoji($emoji);
		$deck->setCreatedAt(new \DateTime());

		$this->mapper->insert($deck);
	}
}
