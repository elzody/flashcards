<?php

namespace OCA\Flashcards\Controller;

use OCA\Flashcards\AppInfo\Application;
use OCA\Flashcards\Service\DeckService;
use OCP\AppFramework\Http\Attribute\ApiRoute;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\ApiController;
use OCP\AppFramework\Http;
use OCP\IRequest;

class DeckController extends ApiController
{
	public function __construct(
		IRequest $request,
		private DeckService $deckService
	) {
		parent::__construct(Application::APP_NAME, $request);
	}

	#[ApiRoute('POST', '/api/v1/decks')]
	public function create(string $name): DataResponse
	{
		// TODO: error handling?
		$this->deckService->create($name, null);

		return new DataResponse([], Http::STATUS_OK);
	}

	#[ApiRoute('GET', '/api/v1/decks')]
	public function show(?int $id = null)
	{
		$db_decks = $this->deckService->findAll();
		$decks = [];

		foreach ($db_decks as $deck) {
			array_push($decks, [
				'name' => $deck->getName(),
				'emoji' => $deck->getEmoji(),
			]);
		}

		return new DataResponse($decks, Http::STATUS_OK);
	}
}
