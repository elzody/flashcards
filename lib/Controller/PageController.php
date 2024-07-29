<?php

namespace OCA\Flashcards\Controller;

use OCA\Flashcards\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\Attribute\FrontpageRoute;
use OCP\AppFramework\Http\Attribute\NoAdminRequired;
use OCP\AppFramework\Http\Attribute\NoCSRFRequired;
use OCP\IRequest;

class PageController extends Controller {
	public function __construct(IRequest $request) {
		parent::__construct(Application::APP_NAME, $request);
	}

    /**
     * @return TemplateResponse<int,array<string,mixed>>
     */
    #[NoCSRFRequired]
    #[NoAdminRequired]
    #[FrontpageRoute(verb: 'GET', url: '/')]
	public function index(): TemplateResponse {
		return new TemplateResponse(Application::APP_NAME, 'main');
	}
}