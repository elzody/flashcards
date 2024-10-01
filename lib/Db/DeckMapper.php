<?php

namespace OCA\Flashcards\Db;

use OCA\Flashcards\Db\Deck;
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

	public function findAll(?string $userId = null)
	{
		$query = $this->db->getQueryBuilder();

		$query->select('*')->from($this->table);

		if ($userId !== null && $userId !== '') {
			$expr = $query
				->expr()
				->eq(
					'owner',
					$query->createNamedParameter(
						$userId,
						IQueryBuilder::PARAM_STR
					)
				);

			$query->where($expr);
		}

		return $this->findEntities($query);
	}
}
