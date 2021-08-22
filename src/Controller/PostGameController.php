<?php

namespace App\Controller;

use App\Message\CreateGameMessage;
use App\Tests\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class PostGameController extends AbstractApiController
{
    #[Route('/games', name: 'post_game', methods: ['POST'], format: 'json')]
    public function __invoke(CreateGameMessage $message): Response
    {
        $envelope = $this->bus->dispatch($message);
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);
        return $this->json($handledStamp->getResult());
    }
}
