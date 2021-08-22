<?php

namespace App\MessageHandler;

use App\Entity\Game;
use App\Entity\Player;
use App\Message\CreatePlayerMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreatePlayerMessageHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(CreatePlayerMessage $message): Player
    {
        $game = $this->manager->find(Game::class, $message->getGameId());
        if (null === $game) {
            throw new BadRequestHttpException('Game not found');
        }

        $player = new Player($message->getName(), $game);

        $this->manager->persist($player);
        $this->manager->flush();

        return $player;
    }
}