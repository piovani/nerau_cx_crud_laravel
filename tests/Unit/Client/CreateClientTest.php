<?php

namespace Tests\Unit\Client;

use App\Models\Client;
use App\Services\Client\CreateClient;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    public function testMostCreateClient()
    {
        $data = [
            'name' => 'TESTE',
            'email' => 'teste@teste.com',
            'phone' => '(44) 99999-9999',
        ];

        /** @var Client $client */
        $client = call_user_func(new CreateClient(), $data);
        $clientDB = Client::all()->first();

        $this->assertEquals($data['name'], $client->name);
        $this->assertEquals($data['email'], $client->email);
        $this->assertEquals($data['phone'], $client->phone);
        $this->assertEquals($data['name'], $clientDB->name);
        $this->assertEquals($data['email'], $clientDB->email);
        $this->assertEquals($data['phone'], $clientDB->phone);
    }
}
