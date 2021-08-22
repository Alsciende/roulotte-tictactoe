<?php

namespace App\Tests\Controller;

use App\Entity\Game;
use App\Message\CreateGameMessage;
use App\Tests\ApiTestCase;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class PostPlayerControllerTest extends ApiTestCase
{
    public function testSuccess(): void
    {
        $envelope = self::$bus->dispatch(new CreateGameMessage('Test', 2, 2));
        /** @var Game $game */
        $game = $envelope->last(HandledStamp::class)->getResult();

        $data = ['name' => 'Alsciende', 'gameId' => $game->getId()];
        $response = self::sendRequest('POST', '/players', $data, 200);
        $this->assertNotEmpty($response['id']);
    }
}
