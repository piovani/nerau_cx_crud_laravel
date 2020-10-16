<?php

namespace Tests\Unit\Client;

use App\Models\Client;
use App\Services\Client\GetClient;
use Tests\TestCase;

class GetClientTest extends TestCase
{
    public function testMustGetClient()
    {
        $clientBase = Client::factory()->create();

        /** @var Client $clientReturn */
        $clientReturn = call_user_func(new GetClient(), $clientBase->id);

        $this->assertEquals($clientBase->id, $clientReturn->id);
        $this->assertEquals($clientBase->name, $clientReturn->name);
        $this->assertEquals($clientBase->email, $clientReturn->email);
        $this->assertEquals($clientBase->phone, $clientReturn->phone);
    }
}
