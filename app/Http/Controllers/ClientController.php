<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\Client\CreateClient;
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

    public function show($client)
    {
        $client = Client::find($client);

        if (empty($client)) {
            return response()->json(['Message' => 'Cliente nao encontrado']);
        }

        return response()->json($client->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
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
