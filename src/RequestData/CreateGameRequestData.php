<?php

namespace App\RequestData;

use Symfony\Component\Validator\Constraints as Assert;

class CreateGameRequestData implements RequestDataInterface
{
    /**
     * @var mixed
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     */
    public $name;

    /**
     * @var mixed
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    public $minPlayers;

    /**
     * @var mixed
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     * @Assert\GreaterThanOrEqual(propertyPath="minPlayers")
     */
    public $maxPlayers;
}