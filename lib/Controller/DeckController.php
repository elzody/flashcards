<?php

namespace OCA\Flashcards\Controller;

use OCA\Flashcards\AppInfo\Application;
use OCA\Flashcards\Exception\NotFound;
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
			$createdDeck = $this->deckService->create($name, $emoji);
		} catch (InternalError) {
			return new DataResponse([], Http::STATUS_INTERNAL_SERVER_ERROR);
		}

		return new DataResponse(
			$createdDeck->jsonSerialize(),
			Http::STATUS_CREATED
		);
	}

	#[ApiRoute('GET', '/api/v1/decks')]
	public function show(?int $id = null): DataResponse
	{
		if ($id !== null) {
			try {
				$deck = $this->deckService->find($id);
			} catch (NotFound) {
				return new DataResponse([], Http::STATUS_NOT_FOUND);
			} catch (InternalError) {
				return new DataResponse([], Http::STATUS_INTERNAL_SERVER_ERROR);
			}

			return new DataResponse($deck->jsonSerialize(), Http::STATUS_OK);
		}

		$db_decks = $this->deckService->findAll();
		$decks = array_map(fn($deck) => $deck->jsonSerialize(), $db_decks);

		return new DataResponse($decks, Http::STATUS_OK);
	}
}
