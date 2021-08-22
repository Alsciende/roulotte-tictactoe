<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Messenger\MessageBusInterface;

class ApiTestCase extends WebTestCase
{
    protected static KernelBrowser $client;
    protected static MessageBusInterface $bus;

    public function setUp(): void
    {
        parent::setUp();

        self::$client = static::createClient();

        $container = static::getContainer();
        /** @var MessageBusInterface $bus */
        $bus = $container->get('messenger.bus.default');

        self::$bus = $bus;
    }

    public static function sendRequest(string $method, string $uri, array $parameters, int $expectedCode): array
    {
        self::$client->jsonRequest($method, $uri, $parameters);
        self::assertResponseStatusCodeSame($expectedCode);

        $content = self::$client->getResponse()->getContent();
        self::assertResponseFormatSame('json');
        self::assertJson($content);
        $data = json_decode($content, true);
        self::assertIsArray($data);
        return $data;
    }
}