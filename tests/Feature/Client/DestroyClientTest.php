<?php

namespace Tests\Feature\Client;

use App\Models\Client;

class DestroyClientTest extends ClientController
{
    public function testMustDestroyClient()
    {
        $clientBase = Client::factory()->create();
        $response = $this->delete(sprintf("%s/%s", $this->baseUrl, $clientBase->id));
        $clientsReturn = Client::all();

        $response->assertStatus(204);
        $this->assertEmpty($clientsReturn);
    }
}
