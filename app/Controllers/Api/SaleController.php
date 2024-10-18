<?php

namespace App\Controllers\Api;

use Framework\AuthTokenController as Controller;
use App\Models\Sale;
use Framework\Response;


class SaleController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function getAll($parameters)
    {
        $this->authToken();
        $response = new Response();

        if (!isset($parameters['id'])) {
            $sales = Sale::orderBy('created_at', 'DESC')
                ->with(['orders', 'client', 'orders.product', 'orders.ingredients', 'orders.size'])
                ->get();
            $response->json($sales->toArray());
        } else {
            $sale = Sale::with(['orders', 'client', 'orders.product', 'orders.ingredients', 'orders.size'])
                ->find($parameters['id']);
            $response->json($sale->toArray());
        }
    }

    public function postAll()
    {
        $this->authToken();
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $sale = new Sale();
            $sale->ivaRate = $request['ivaRate'];
            $sale->clientId = $request['client']['id'];
            $sale->save();

            $response->json($sale::with('client', 'orders')->find($sale->id)->toArray());
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
            $sale = Sale::find($parameters['id']);

            $sale->paid = $request['paid'];

            $sale->save();

            $response->json($sale->toArray());
        } catch (\Exception $e) {
            $response->json(['error' => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }
}
