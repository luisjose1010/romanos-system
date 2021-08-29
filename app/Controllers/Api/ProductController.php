<?php

namespace App\Controllers\Api;

use Framework\Controller;
use App\Models\ProductModel;
use Framework\Response;


class ProductController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get(array $parameters)
    {
        if (!isset($parameters['id'])) {
            $products = ProductModel::all();

            $data = [];

            foreach($products as $index => $product){

                // Crea la estructura de un array convertible a JSON
                $data[$index]['id'] = $product->id;
                $data[$index]['name'] = $product->name;
                $data[$index]['ingredients'] = $product->ingredients->toArray();
                $data[$index]['sizes'] = $product->sizes->toArray();
                $data[$index]['multipleIngredients'] = $product->multipleIngredients == 1 ? true : false;
            }
            
            $response = new Response();
            $response->json($data);
        }
    }
}
