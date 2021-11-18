<?php

namespace App\Controllers\Api;

use Framework\Controller;
use App\Models\Client;
use Framework\Response;


class ClientController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get($parameters)
    {
        $response = new Response();

        if (!isset($parameters['id'])) {
            $clients = Client::all();
            $response->json($clients->toArray());
        } else {
            $clients = Client::find($parameters['id']);
            $response->json($clients->toArray());
        }
    }

    public function post()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $client = Client::create($request);
            $response->json($client::with('client', 'orders')->find($client->id)->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }

    public function put($parameters)
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $client = Client::find($parameters['id']);
            $client->fill($request);

            $response->json($client::with('client', 'orders')->find($client->id)->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }
}
