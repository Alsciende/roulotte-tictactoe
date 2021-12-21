<?php

namespace App\EventListener;

use App\Exception\ValidationHttpException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class ValidationHttpExceptionListener implements EventSubscriberInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public static function getSubscribedEvents(): array
    {
        return array(
            KernelEvents::EXCEPTION => [ 'onKernelException', 0 ]
        );
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (false === $exception instanceof ValidationHttpException) {
            return;
        }

        $content = $this->serializer->serialize($exception->getErrors(), 'json');
        $response = new Response($content, 400);

        $event->setResponse($response);
    }
}