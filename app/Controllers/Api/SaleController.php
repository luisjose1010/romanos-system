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

    public function getAll()
    {
        if (!isset($parameters['id'])) {
            $sales = Sale::with(['orders', 'orders.ingredients', 'orders.size'])->get();

            $response = new Response();
            $response->json($sales->toArray());
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
