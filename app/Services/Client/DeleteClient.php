<?php

namespace App\Services\Client;

class DeleteClient
{
    public function __invoke(string $id): void
    {
        $client = call_user_func(new GetClient(), $id);

        $client->delete();
    }
}
