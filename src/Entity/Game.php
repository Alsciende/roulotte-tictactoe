<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $minPlayers;

    /**
     * @ORM\Column(type="integer")
     */
    private int $maxPlayers;

    /**
     * @param string $name
     * @param int    $minPlayers
     * @param int    $maxPlayers
     */
    public function __construct(string $name, int $minPlayers, int $maxPlayers)
    {
        $this->id = Uuid::v4();
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