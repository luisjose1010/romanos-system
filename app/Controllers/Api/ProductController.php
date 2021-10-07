<?php

namespace App\Controllers\Api;

use Framework\Controller;
use App\Models\ProductModel as Product;
use App\Models\IngredientModel as Ingredient;
use App\Models\SizeModel as Size;
use Framework\Response;


class ProductController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get(array $parameters)
    {
        if (!isset($parameters['id'])) {
            $products = Product::with(['ingredient', 'size'])->get();

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
