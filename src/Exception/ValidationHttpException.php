<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationHttpException extends BadRequestHttpException
{
    /** @var ConstraintViolationListInterface|ConstraintViolationInterface[] $errors */
    private ConstraintViolationListInterface $errors;

    /**
     * @param ConstraintViolationListInterface|ConstraintViolationInterface[] $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;
        parent::__construct();
    }

    /**
     * @return ConstraintViolationListInterface|ConstraintViolationInterface[]
     */
    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}