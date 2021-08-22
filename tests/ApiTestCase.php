<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTestCase extends WebTestCase
{
    public static function sendRequest(string $method, string $uri, array $parameters, int $expectedCode): array
    {
        $client = static::createClient();
        $client->jsonRequest($method, $uri, $parameters);
        self::assertResponseStatusCodeSame($expectedCode);

        $content = $client->getResponse()->getContent();
        self::assertResponseFormatSame('json');
        self::assertJson($content);
        $data = json_decode($content, true);
        self::assertIsArray($data);
        return $data;
    }
}