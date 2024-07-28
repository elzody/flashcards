<?php

namespace OCA\Flashcards\Controller;

use OCA\Flashcards\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;

class PageController extends Controller {
	public function __construct(IRequest $request) {
		parent::__construct(Application::APP_NAME, $request);
	}

	#[Route('GET', '/')]
	public function index(): TemplateResponse {
		return new TemplateResponse(Application::APP_NAME, 'main');
	}
}