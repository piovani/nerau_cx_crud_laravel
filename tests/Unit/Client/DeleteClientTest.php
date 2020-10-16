<?php

namespace Tests\Unit\Client;

use App\Models\Client;
use App\Services\Client\CreateClient;
use App\Services\Client\DeleteClient;
use Tests\TestCase;

class DeleteClientTest extends TestCase
{
    public function testMostDeleteClient()
    {
        $client = Client::factory()->create();

        call_user_func(new DeleteClient(), $client->id);

        $this->assertEmpty(Client::all());
    }
}
