<?php

namespace App\Message;

use App\RequestData\RequestDataInterface;

interface MessageInterface
{
    public static function getDataClass(): string;

    public static function fromData(RequestDataInterface $data): self;
}