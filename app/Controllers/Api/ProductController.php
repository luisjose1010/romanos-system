<?php

namespace App\Controllers\Api;

use Framework\AuthTokenController as Controller;
use App\Models\Product;
use Framework\Response;


class ProductController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get(array $parameters)
    {
        $this->authToken();

        if (!isset($parameters['id'])) {
            $products = Product::all();

            $response = new Response();
            $response->json($products->toArray());
        }
    }

    public function getAll(array $parameters)
    {
        $this->authToken();

        if (!isset($parameters['id'])) {
            $products = Product::with(['ingredients', 'sizes'])->get();

            $response = new Response();
            $response->json($products->toArray());
        }
    }

    public function getIngredients(array $parameters)
    {
        $this->authToken();

        if (!isset($parameters['id'])) {
            $products = Product::with(['ingredients'])->get();

            $response = new Response();
            $response->json($products->toArray());
        }
    }

    public function getSizes(array $parameters)
    {
        $this->authToken();

        if (!isset($parameters['id'])) {
            $products = Product::with(['sizes'])->get();

            $response = new Response();
            $response->json($products->toArray());
        }
    }


    public function post(array $parameters)
    {
        $this->authToken();

        $request = json_decode(file_get_contents('php://input'), true);

        $product = Product::create($request);

        $response = new Response();
        $response->json($product->toArray());
    }
}
