<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

class Fact
{
    /**
     * @MongoDB\Id
     */
    protected string $id;

    public function getId(): string
    {
        return $this->id;
    }
}