<?php

namespace Tests\Feature\Client;

use App\Models\Client;

class UpdateClientTest extends ClientController
{
    public function testMustRouteUpdateClient()
    {
        $client = Client::factory()->create();
        $data = [
            'name' => 'Teste 1',
            'email' => "email@email.com",
            'phone' => '(44) 9999-9999',
        ];

        $response = $this->put(sprintf("%s/%s", $this->baseUrl, $client->id), $data);
        $content = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertIsArray($content);
        $this->assertEquals($client->id, $content['id']);
        $this->assertEquals($data['name'], $content['name']);
        $this->assertEquals($data['email'], $content['email']);
        $this->assertEquals($data['phone'], $content['phone']);
    }
}
