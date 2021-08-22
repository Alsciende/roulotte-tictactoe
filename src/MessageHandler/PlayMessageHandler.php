<?php

namespace App\MessageHandler;

use App\Document\PlayedPosition;
use App\Message\PlayMessage;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class PlayMessageHandler implements MessageHandlerInterface
{
    private DocumentManager $manager;

    public function __construct(DocumentManager $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(PlayMessage $message): void
    {
        $fact = new PlayedPosition($message->getX(), $message->getY());

        $this->manager->persist($fact);
        $this->manager->flush();
    }
}