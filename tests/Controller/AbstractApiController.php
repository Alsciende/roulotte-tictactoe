<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractApiController extends AbstractController
{
    protected ValidatorInterface $validator;
    protected SerializerInterface $serializer;
    protected MessageBusInterface $bus;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer, MessageBusInterface $bus)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->bus = $bus;
    }
}