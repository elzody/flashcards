<?php

declare(strict_types = 1);

namespace OCA\Flashcards\AppInfo;

use OCP\AppFramework\App;

class Application extends App {
	public const APP_NAME = 'flashcards';

	public function __construct(array $params = []) {
		parent::__construct(self::APP_NAME, $params);
	}
}