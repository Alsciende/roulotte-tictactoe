<?php

namespace App\ParamConverter;

use App\RequestData\RequestDataInterface;

class InvalidDataClassException extends \LogicException
{
    public string $dataClass;
    public string $messageClass;

    /**
     * @param string $dataClass
     * @param string $messageClass
     */
    public function __construct(string $dataClass, string $messageClass)
    {
        $this->dataClass = $dataClass;
        $this->messageClass = $messageClass;

        parent::__construct(
            sprintf(
                "Data class %s declared from message class %s does not implement %s.",
                $dataClass,
                $messageClass,
                RequestDataInterface::class
            )
        );
    }
}