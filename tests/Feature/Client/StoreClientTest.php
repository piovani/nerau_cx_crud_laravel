<?php

namespace Tests\Feature\Client;

class StoreClientTest extends ClientController
{
    public function testMustStoreCreateClient()
    {
        $data = [
            'name' => 'Teste 1',
            'email' => "email@email.com",
            'phone' => '(44) 9999-9999',
        ];

        $response = $this->postJson($this->baseUrl, $data);
        $content = json_decode($response->content(), true);

        $response->assertStatus(201);
        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('name', $content);
        $this->assertArrayHasKey('email', $content);
        $this->assertArrayHasKey('phone', $content);
        $this->assertArrayHasKey('updated_at', $content);
        $this->assertArrayHasKey('created_at', $content);
        $this->assertEquals($data['name'], $content['name']);
        $this->assertEquals($data['email'], $content['email']);
        $this->assertEquals($data['phone'], $content['phone']);
    }
}
