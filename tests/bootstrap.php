<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2026 Elizabeth Danzberger
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

use OCP\App\IAppManager;
use OCP\Server;

$serverBootstrap = dirname(__DIR__) . '/../../tests/bootstrap.php';

if (
	!is_file($serverBootstrap) &&
	class_exists(\OC::class, false) &&
	\OC::$SERVERROOT !== ''
) {
	$serverBootstrap = \OC::$SERVERROOT . '/tests/bootstrap.php';
}

if (is_file($serverBootstrap)) {
	if (!defined('PHPUNIT_RUN')) {
		require_once $serverBootstrap;
	}

	Server::get(IAppManager::class)->loadApp('flashcards');
	\OC_Hook::clear();
} else {
	$composerAutoloader = dirname(__DIR__) . '/vendor/autoload.php';
	if (is_file($composerAutoloader)) {
		require_once $composerAutoloader;
	}

	spl_autoload_register(static function (string $class): void {
		$prefixes = [
			'OCA\\Flashcards\\Tests\\' => __DIR__,
			'OCA\\Flashcards\\' => dirname(__DIR__) . '/lib',
		];

		foreach ($prefixes as $prefix => $directory) {
			if (!str_starts_with($class, $prefix)) {
				continue;
			}

			$file =
				$directory .
				'/' .
				str_replace('\\', '/', substr($class, strlen($prefix))) .
				'.php';
			if (is_file($file)) {
				require_once $file;
			}
		}
	});

	if (!class_exists(\Test\TestCase::class)) {
		class_alias(\PHPUnit\Framework\TestCase::class, \Test\TestCase::class);
	}
}
