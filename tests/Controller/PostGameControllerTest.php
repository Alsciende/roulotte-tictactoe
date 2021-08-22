<?php

namespace App\Tests\Controller;

use App\Tests\ApiTestCase;

class PostGameControllerTest extends ApiTestCase
{
    public function testSuccess(): void
    {
        $data = [ 'name' => 'New Game', 'minPlayers' => 2, 'maxPlayers' => 2 ];
        $response = self::sendRequest('POST', '/games', $data, 200);
        $this->assertResponseIsSuccessful();
        dump($response);
    }

    public function testName(): void
    {
        $data = [ 'name' => '', 'minPlayers' => 2, 'maxPlayers' => 2 ];
        $response = self::sendRequest('POST', '/games', $data, 400);
        dump($response);
        $this->assertEquals('Validation Failed', $response['title']);
    }
/*
    public function testMinPlayers(): void
    {
        $data = [ 'name' => 'New Game', 'maxPlayers' => 2 ];
        $response = self::sendRequest('POST', '/games', $data, 400);
        $this->assertEquals('Validation Failed', $response['title']);
    }

    public function testMaxPlayers(): void
    {
        $data = [ 'name' => 'New Game', 'minPlayers' => 2 ];
        $response = self::sendRequest('POST', '/games', $data, 400);
        $this->assertEquals('Validation Failed', $response['title']);
    }*/
}
