<?php

namespace App\Tests\Controller;

use App\Entity\Game;
use App\Message\CreateGameMessage;
use App\Tests\ApiTestCase;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class ListGamesControllerTest extends ApiTestCase
{
    public function testSuccess(): void
    {
        $envelope = self::$bus->dispatch(new CreateGameMessage('Test', 2, 2));
        /** @var Game $game */
        $game = $envelope->last(HandledStamp::class)->getResult();

        $response = self::sendRequest('GET', '/games');
        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
        $game = $response[0];
        $this->assertIsArray($game);
        $this->assertNotEmpty($game['id']);
        $this->assertNotEmpty($game['createdAt']);
    }
}
