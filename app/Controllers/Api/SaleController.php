<?php

namespace App\Controllers\Api;

use Framework\Controller;
use App\Models\Sale;
use Framework\Response;


class SaleController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function getAll($parameters)
    {
        $response = new Response();

        if (!isset($parameters['id'])) {
            $sales = Sale::orderBy('created_at', 'DESC')
                ->with(['orders', 'orders.product', 'orders.ingredients', 'orders.size'])
                ->get();
            $response->json($sales->toArray());
        } else {
            $sale = Sale::with(['orders', 'orders.product', 'orders.ingredients', 'orders.size'])
                ->find($parameters['id']);
            $response->json($sale->toArray());
        }
    }

    public function post()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $sale = Sale::create($request);

            $response->json($sale->toArray());
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
