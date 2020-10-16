<?php

namespace App\Services\Client;

use App\Models\Client;

class CreateClient
{
    public function __invoke(array $data): Client
    {
        return Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }
}
