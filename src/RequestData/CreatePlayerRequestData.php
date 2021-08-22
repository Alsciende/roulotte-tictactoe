<?php

namespace App\RequestData;

class CreatePlayerRequestData implements RequestDataInterface
{
    public string $name;
    public string $gameId;
}