<?php

namespace Tests\Feature\Client;

use App\Models\Client;

class IndexClientTest extends ClientController
{

    public function testMustGetListOfClients()
    {
        $quantity = 10;
        Client::factory()->count($quantity)->create();
        $response = $this->get($this->baseUrl);
        $content = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertEquals($quantity, count($content));
        $this->assertIsArray($content);
        $this->assertArrayHasKey('id', $content[0]);
        $this->assertArrayHasKey('name', $content[0]);
        $this->assertArrayHasKey('email', $content[0]);
        $this->assertArrayHasKey('phone', $content[0]);
    }
}
