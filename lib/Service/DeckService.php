<?php

namespace OCA\Flashcards\Service;

use OCA\Flashcards\Db\Deck;
use OCA\Flashcards\Db\DeckMapper;
use OCA\Flashcards\Exception\InternalError;
use OCP\IUserSession;
use Psr\Log\LoggerInterface;

class DeckService
{
	public function __construct(
		private DeckMapper $mapper,
		private IUserSession $userSession,
		private LoggerInterface $logger
	) {
	}

	public function findAll(?string $userId = null)
	{
		return $this->mapper->findAll($userId);
	}

	public function create(string $name, string $emoji)
	{
		$user = $this->userSession->getUser();

		$deck = new Deck();
		$deck->setOwner($user?->getUID());
		$deck->setName($name);
		$deck->setEmoji($emoji);
		$deck->setCreatedAt(new \DateTime());

		try {
			$this->mapper->insert($deck);
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage());
			throw new InternalError($e->getMessage());
		}
	}
}
