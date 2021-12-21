<?php

namespace App\ParamConverter;

use App\Exception\ValidationHttpException;
use App\Message\MessageInterface;
use App\RequestData\RequestDataInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDataParamConverter implements ParamConverterInterface
{
    private SerializerInterface $serializer;

    private ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        /** @var string $name */
        $name = $configuration->getName();

        /** @var MessageInterface $messageClass */
        $messageClass = $configuration->getClass();

        $dataClass = $messageClass::getDataClass();

        $dataObject = $this->serializer->deserialize($request->getContent(), $dataClass, 'json');

        if (false === $dataObject instanceof RequestDataInterface) {
            throw new InvalidDataClassException($dataClass, $configuration->getClass());
        }

        $errors = $this->validator->validate($dataObject);

        if (count($errors) > 0) {
            throw new ValidationHttpException($errors);
        }

        $message = $messageClass::fromData($dataObject);

        $request->attributes->set($name, $message);

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        $class = $configuration->getClass();
        if (false === is_a($class, MessageInterface::class, true)) {
            return false;
        }

        return true;
    }
}