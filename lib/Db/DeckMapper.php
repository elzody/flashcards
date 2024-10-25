<?php

namespace OCA\Flashcards\Db;

use OCA\Flashcards\Db\Deck;
use OCP\AppFramework\Db\Entity;
use OCP\IDBConnection;
use OCP\AppFramework\Db\QBMapper;
use OCP\DB\QueryBuilder\IQueryBuilder;

class DeckMapper extends QBMapper
{
	protected string $table = 'flashcards_decks';

	public function __construct(IDBConnection $db)
	{
		parent::__construct($db, $this->table, Deck::class);
	}

	public function find(int $deckId, string $userId): Entity
	{
		$query = $this->db->getQueryBuilder();

		$whereUserId = $query
			->expr()
			->eq('owner', $query->createNamedParameter($userId));

		$whereDeckId = $query
			->expr()
			->eq(
				'id',
				$query->createNamedParameter($deckId, IQueryBuilder::PARAM_INT)
			);

		$query
			->select('*')
			->from($this->table)
			->where($whereUserId)
			->andWhere($whereDeckId);

		return $this->findEntity($query);
	}

	public function findAll(?string $userId = null): array
	{
		$query = $this->db->getQueryBuilder();

		$query->select('*')->from($this->table);

		if ($userId !== null && $userId !== '') {
			$expr = $query
				->expr()
				->eq('owner', $query->createNamedParameter($userId));

			$query->where($expr);
		}

		return $this->findEntities($query);
	}
}
