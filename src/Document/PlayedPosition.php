<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="positions")
 */
class PlayedPosition extends Fact
{
    /**
     * @MongoDB\Field(type="int")
     */
    protected int $x;

    /**
     * @MongoDB\Field(type="int")
     */
    protected int $y;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}