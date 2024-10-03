<?php

namespace OCA\Flashcards\Controller;

use OCA\Flashcards\AppInfo\Application;
use OCA\Flashcards\Service\DeckService;
use OCA\Flashcards\Exception\InternalError;
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
	public function create(string $name, string $emoji): DataResponse
	{
		try {
			$this->deckService->create($name, $emoji);
		} catch (InternalError $e) {
			return new DataResponse([], Http::STATUS_INTERNAL_SERVER_ERROR);
		}

		return new DataResponse([], Http::STATUS_OK);
	}

	#[ApiRoute('GET', '/api/v1/decks')]
	public function show(?int $id = null)
	{
		if ($id !== null) {
			$deck = $this->deckService->find($id);

			return new DataResponse($deck->jsonSerialize(), Http::STATUS_OK);
		}

		$db_decks = $this->deckService->findAll();
		$decks = [];

		foreach ($db_decks as $deck) {
			array_push($decks, $deck->jsonSerialize());
		}

		return new DataResponse($decks, Http::STATUS_OK);
	}
}
