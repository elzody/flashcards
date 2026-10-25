<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2026 Elizabeth Danzberger
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\Flashcards\Tests\Service;

use DateTimeInterface;
use OCA\Flashcards\Db\Deck;
use OCA\Flashcards\Db\DeckMapper;
use OCA\Flashcards\Exception\InternalError;
use OCA\Flashcards\Exception\NotFound;
use OCA\Flashcards\Service\DeckService;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\IUser;
use OCP\IUserSession;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Test\TestCase;

#[CoversClass(DeckService::class)]
class DeckServiceTest extends TestCase
{
	private DeckMapper&MockObject $mapper;
	private IUserSession&MockObject $userSession;
	private LoggerInterface&MockObject $logger;
	private DeckService $service;

	protected function setUp(): void
	{
		parent::setUp();

		$this->mapper = $this->createMock(DeckMapper::class);
		$this->userSession = $this->createMock(IUserSession::class);
		$this->logger = $this->createMock(LoggerInterface::class);

		$this->service = new DeckService(
			$this->mapper,
			$this->userSession,
			$this->logger,
		);
	}

	public function testFindReturnsDeckForCurrentUser(): void
	{
		$deck = new Deck();
		$deck->setId(42);

		$user = $this->createMock(IUser::class);
		$user->expects($this->once())->method('getUID')->willReturn('alice');

		$this->userSession
			->expects($this->once())
			->method('getUser')
			->willReturn($user);

		$this->mapper
			->expects($this->once())
			->method('find')
			->with(42, 'alice')
			->willReturn($deck);

		$this->assertSame($deck, $this->service->find(42));
	}

	public function testFindThrowsNotFoundWhenDeckDoesNotExist(): void
	{
		$user = $this->createMock(IUser::class);
		$user->method('getUID')->willReturn('alice');
		$this->userSession->method('getUser')->willReturn($user);

		$this->mapper
			->method('find')
			->willThrowException(
				new DoesNotExistException('Deck does not exist'),
			);

		$this->logger
			->expects($this->once())
			->method('error')
			->with('Deck does not exist');

		$this->expectException(NotFound::class);

		$this->service->find(42);
	}

	public function testFindThrowsInternalErrorOnUnexpectedException(): void
	{
		$user = $this->createMock(IUser::class);
		$user->method('getUID')->willReturn('alice');
		$this->userSession->method('getUser')->willReturn($user);

		$this->mapper
			->method('find')
			->willThrowException(new \RuntimeException('Database unavailable'));

		$this->logger
			->expects($this->once())
			->method('error')
			->with('Database unavailable');

		$this->expectException(InternalError::class);
		$this->expectExceptionMessage('Database unavailable');

		$this->service->find(42);
	}

	public function testFindAllWithoutUserDelegatesToMapper(): void
	{
		$decks = [new Deck()];

		$this->mapper
			->expects($this->once())
			->method('findAll')
			->with(null)
			->willReturn($decks);

		$this->assertSame($decks, $this->service->findAll());
	}

	public function testFindAllWithUserDelegatesToMapper(): void
	{
		$decks = [new Deck()];

		$this->mapper
			->expects($this->once())
			->method('findAll')
			->with('alice')
			->willReturn($decks);

		$this->assertSame($decks, $this->service->findAll('alice'));
	}

	public function testCreateBuildsAndPersistsDeck(): void
	{
		$user = $this->createMock(IUser::class);
		$user->method('getUID')->willReturn('alice');
		$this->userSession->method('getUser')->willReturn($user);

		$this->mapper
			->expects($this->once())
			->method('insert')
			->willReturnCallback(static function (Deck $deck): Deck {
				$deck->setId(7);

				return $deck;
			});

		$deck = $this->service->create('Spanish', '📚');

		$this->assertSame(7, $deck->getId());
		$this->assertSame('alice', $deck->getOwner());
		$this->assertSame('Spanish', $deck->getName());
		$this->assertSame('📚', $deck->getEmoji());
		$this->assertInstanceOf(
			DateTimeInterface::class,
			$deck->getCreatedAt(),
		);
	}

	public function testCreateThrowsInternalErrorWhenInsertFails(): void
	{
		$user = $this->createMock(IUser::class);
		$user->method('getUID')->willReturn('alice');
		$this->userSession->method('getUser')->willReturn($user);

		$this->mapper
			->method('insert')
			->willThrowException(new \RuntimeException('Insert failed'));

		$this->logger
			->expects($this->once())
			->method('error')
			->with('Insert failed');

		$this->expectException(InternalError::class);
		$this->expectExceptionMessage('Insert failed');

		$this->service->create('Spanish', '📚');
	}
}
