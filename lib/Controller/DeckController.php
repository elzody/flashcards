<?php

namespace OCA\Flashcards\Controller;

use OCA\Flashcards\AppInfo\Application;
use OCP\AppFramework\Http\Attribute\ApiRoute;
use OCP\AppFramework\Http\Response;
use OCP\AppFramework\ApiController;
use OCP\AppFramework\Http;
use OCP\IRequest;

class DeckController extends ApiController
{
	public function __construct(IRequest $request)
	{
		parent::__construct(Application::APP_NAME, $request);
	}

	#[ApiRoute('POST', '/api/v1/create')]
	public function create(string $name): Response
	{
		return new Response(Http::STATUS_OK);
	}
}
