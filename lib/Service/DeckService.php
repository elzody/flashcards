<?php

namespace OCA\Flashcards\Service;

use OCA\Flashcards\Db\Deck;
use OCA\Flashcards\Db\DeckMapper;
use OCA\Flashcards\Exception\InternalError;
use OCA\Flashcards\Exception\NotFound;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;
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

	public function find(int $deckId)
	{
		$user = $this->userSession->getUser();

		try {
			return $this->mapper->find($deckId, $user->getUID());
		} catch (DoesNotExistException $e) {
			$this->logger->error($e->getMessage());
			throw new NotFound();
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage());
			throw new InternalError($e->getMessage());
		}
	}

	public function findAll(?string $userId = null)
	{
		return $this->mapper->findAll($userId);
	}

	public function create(string $name, string $emoji): Deck
	{
		try {
			$user = $this->userSession->getUser();

			$deck = new Deck();
			$deck->setOwner($user?->getUID());
			$deck->setName($name);
			$deck->setEmoji($emoji);
			$deck->setCreatedAt(new \DateTime());

			return $this->mapper->insert($deck);
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage());
			throw new InternalError($e->getMessage());
		}
	}
}
