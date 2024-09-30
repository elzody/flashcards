<?php

namespace OCA\Flashcards\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\DB\Types;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

class Version001000 extends SimpleMigrationStep
{
	public function changeSchema(
		IOutput $output,
		Closure $schemaClosure,
		array $options
	): ?ISchemaWrapper {
		$schema = $schemaClosure($options);

		$this->createDecksTable($schema);

		return $schema;
	}

	private function createDecksTable(mixed $schema): void
	{
		$table = 'flashcards_decks';

		if (!$schema->hasTable($table)) {
			$table = $schema->createTable($table);

			$table->addColumn('id', Types::INTEGER, [
				'autoincrement' => true,
				'notnull' => true,
			]);

			$table->addColumn('owner', Types::STRING, [
				'notnull' => true,
			]);

			$table->addColumn('name', Types::STRING, [
				'notnull' => true,
			]);

			$table->addColumn('emoji', Types::STRING, [
				'notnull' => true,
			]);

			$table->addColumn('created_at', Types::DATETIME, [
				'notnull' => true,
			]);

			$table->setPrimaryKey(['id']);
		}
	}
}
