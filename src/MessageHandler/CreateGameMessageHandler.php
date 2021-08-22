<?php

namespace App\MessageHandler;

use App\Document\Game;
use App\Message\CreateGameMessage;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateGameMessageHandler implements MessageHandlerInterface
{
    private DocumentManager $manager;

    public function __construct(DocumentManager $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(CreateGameMessage $message): Game
    {
        $game = new Game($message->getName(), $message->getMinPlayers(), $message->getMaxPlayers());

        $this->manager->persist($game);
        $this->manager->flush();

        return $game;
    }
}