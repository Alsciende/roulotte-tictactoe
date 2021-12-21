<?php

namespace App\Message;

use App\RequestData\CreateGameRequestData;
use App\RequestData\RequestDataInterface;

class CreateGameMessage implements MessageInterface
{
    private string $name;
    private int $minPlayers;
    private int $maxPlayers;

    public static function fromData(RequestDataInterface $data): self
    {
        if ($data instanceof CreateGameRequestData) {
            // @phpstan-ignore-next-line let it crash if $data is not properly validated
            return new self($data->name, $data->minPlayers, $data->maxPlayers);
        }

        throw new \LogicException("Not the data class supported by this message");
    }

    public static function getDataClass(): string
    {
        return CreateGameRequestData::class;
    }

    /**
     * @param string $name
     * @param int    $minPlayers
     * @param int    $maxPlayers
     */
    public function __construct(string $name, int $minPlayers, int $maxPlayers)
    {
        $this->name = $name;
        $this->minPlayers = $minPlayers;
        $this->maxPlayers = $maxPlayers;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMinPlayers(): int
    {
        return $this->minPlayers;
    }

    public function getMaxPlayers(): int
    {
        return $this->maxPlayers;
    }
}