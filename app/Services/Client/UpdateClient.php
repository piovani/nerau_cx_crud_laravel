<?php

namespace App\Services\Client;

use App\Models\Client;

class UpdateClient
{
    public function __invoke(array $data): ?Client
    {
        $client = call_user_func(new GetClient(), $data['id']);
        $client->update($data);

        return $client;
    }
}
