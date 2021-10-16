<?php

namespace App\Controllers\Api;

use Framework\Controller;
use App\Models\Product;
use Framework\Response;


class ProductController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get(array $parameters)
    {
        if (!isset($parameters['id'])) {
            $products = Product::all();

            $response = new Response();
            $response->json($products->toArray());
        }
    }

    public function getAll(array $parameters)
    {
        if (!isset($parameters['id'])) {
            $products = Product::with(['ingredients', 'sizes'])->get();

            $response = new Response();
            $response->json($products->toArray());
        }
    }

    public function getIngredients(array $parameters)
    {
        if (!isset($parameters['id'])) {
            $products = Product::with(['ingredients'])->get();

            $response = new Response();
            $response->json($products->toArray());
        }
    }

    public function getSizes(array $parameters)
    {
        if (!isset($parameters['id'])) {
            $products = Product::with(['sizes'])->get();

            $response = new Response();
            $response->json($products->toArray());
        }
    }


    public function post(array $parameters)
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $product = Product::create($request);

        $response = new Response();
        $response->json($product->toArray());
    }
}
