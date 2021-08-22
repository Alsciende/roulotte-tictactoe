<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="games")
 */
class Game
{
    /**
     * @MongoDB\Id
     */
    private string $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $name;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $minPlayers;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $maxPlayers;

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

    public function getId(): string
    {
        return $this->id;
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