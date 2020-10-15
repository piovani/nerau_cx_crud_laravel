<?php

namespace App\Services\Client;

use App\Models\Client;

class GetClient
{
    public function __invoke(string $id): ?Client
    {
        return Client::find($id);
    }
}
