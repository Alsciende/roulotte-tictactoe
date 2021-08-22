<?php

namespace App\Message;

use App\RequestData\CreatePlayerRequestData;
use App\RequestData\RequestDataInterface;

class CreatePlayerMessage implements MessageInterface
{
    private string $name;
    private string $gameId;

    public function __construct(string $name, string $gameId)
    {
        $this->name = $name;
        $this->gameId = $gameId;
    }

    public static function getDataClass(): string
    {
        return CreatePlayerRequestData::class;
    }

    public static function fromData(RequestDataInterface $data): MessageInterface
    {
        if ($data instanceof CreatePlayerRequestData) {
            return new self($data->name, $data->gameId);
        }

        throw new \LogicException("Not the data class supported by this message");
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGameId(): string
    {
        return $this->gameId;
    }
}