<?php

namespace App\Controllers\Api;

use Framework\AuthTokenController as Controller;
use App\Models\Client;
use Framework\Response;


class ClientController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get($parameters)
    {
        $this->authToken();
        $response = new Response();

        try {
            if (isset($parameters['id'])) {
                $clients = Client::find($parameters['id']);
                $response->json($clients->toArray());
            } elseif (isset($_GET['idCard'])) {
                // Devuelve el primer registro, ya que se busca por una clave única
                $clients = Client::where('id_card', $_GET['idCard'])->get()->first();

                if ($clients === null) {
                    $response->json(
                        ["error" => "No se ha encontrado el cliente con la cédula {$_GET['idCard']}"],
                        404
                    );
                }
                $response->json($clients->toArray());
            } else {
                $clients = Client::all();
                $response->json($clients->toArray());
            }
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }

    public function getAll($parameters)
    {
        $response = new Response();

        try {
            if (isset($parameters['id'])) {
                $clients = Client::with(['sales'])->find($parameters['id']);
                $response->json($clients->toArray());
            } elseif (isset($_GET['idCard'])) {
                // Devuelve el primer registro, ya que se busca por una clave única
                $clients = Client::where('id_card', $_GET['idCard'])
                    ->with(['sales'])
                    ->first();

                if ($clients === null) {
                    $response->json(
                        ["error" => "No se ha encontrado el cliente con la cédula {$_GET['idCard']}"],
                        404
                    );
                }
                $response->json($clients->toArray());
            } else {
                $clients = Client::with(['sales'])->get();
                $response->json($clients->toArray());
            }
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }


    public function post()
    {
        $this->authToken();
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $client = Client::create($request);
            $response->json($client->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }

    public function put($parameters)
    {
        $this->authToken();
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $client = Client::find($parameters['id']);
            $client->fill($request);

            $client->save();
            $response->json($client->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }
}
