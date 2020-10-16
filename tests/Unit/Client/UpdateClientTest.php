<?php

namespace Tests\Unit\Client;

use App\Models\Client;
use App\Services\Client\UpdateClient;
use Tests\TestCase;

class UpdateClientTest extends TestCase
{
    public function testMustUpdateClient()
    {
        $clientBase = Client::factory()->create();
        $data = [
            'id' => $clientBase->id,
            'name' => 'ALTERADO',
            'email' => 'alterado@email.com',
            'phone' => '(00) 00000-0000',
        ];

        /** @var Client $clientReturn */
        $clientReturn = call_user_func(new UpdateClient(), $data);

        $this->assertEquals($clientReturn->id, $data['id']);
        $this->assertEquals($clientReturn->name, $data['name']);
        $this->assertEquals($clientReturn->email, $data['email']);
        $this->assertEquals($clientReturn->phone, $data['phone']);
    }
}
