<?php

namespace App\Controller;

use App\Message\CreatePlayerMessage;
use App\Tests\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class PostPlayerController extends AbstractApiController
{
    #[Route('/players', name: 'post_player', methods: ['POST'], format: 'json')]
    public function __invoke(CreatePlayerMessage $message): Response
    {
        $envelope = $this->bus->dispatch($message);
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);
        return $this->json($handledStamp->getResult());
    }
}
