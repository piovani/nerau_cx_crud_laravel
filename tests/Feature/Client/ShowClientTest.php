<?php

namespace Tests\Feature\Client;

use App\Models\Client;

class ShowClientTest extends ClientController
{
    public function testMustShowClient()
    {
        $client = Client::factory()->create();

        $response = $this->get(sprintf("%s/%s", $this->baseUrl, $client->id));
        $content = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertIsArray($content);
        $this->assertEquals($client->id, $content['id']);
        $this->assertEquals($client->name, $content['name']);
        $this->assertEquals($client->email, $content['email']);
        $this->assertEquals($client->phone, $content['phone']);
    }
}
