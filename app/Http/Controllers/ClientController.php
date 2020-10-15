<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\Client\CreateClient;
use App\Services\Client\GetClient;
use App\Services\Client\UpdateClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::all());
    }

    public function store(ClientRequest $request)
    {
        /** @var Client $client */
        $client = call_user_func(new CreateClient(), $request->validated());

        return $client;
    }

    public function show(string $id)
    {
        if (empty($client = call_user_func(new GetClient(), $id))) {
            return response()->json(['Message' => 'Cliente nao encontrado']);
        }

        return response()->json($client->toArray());
    }

    public function update(ClientRequest $request, string $id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        $client = call_user_func(new UpdateClient(), $data);

        return response()->json($client->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
