<?php

namespace App\MessageHandler;

use App\Entity\Game;
use App\Message\CreateGameMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateGameMessageHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
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