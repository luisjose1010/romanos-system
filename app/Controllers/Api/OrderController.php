<?php

namespace App\Controllers\Api;

use Framework\Controller;
use Framework\Response;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;


class OrderController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function getAll()
    {
        try {
            $sales = Order::with(['product', 'size', 'ingredients'])->get();

            $response = new Response();
            $response->json($sales->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }

    public function postAll()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $order = new Order();
        $response = new Response();

        try {
            if (!isset($request['product'])) {
                throw new \Exception("No se encuentra el objeto 'product'.");
            }
            if (Product::find($request['product']['id'])->minIngredients > 0) {
                if (isset($request['ingredients'])) {
                    // Verifica que estén correctos los datos
                    $this->checkIngredients($request['ingredients'], $request['product']);
                } else {
                    throw new \Exception("Este producto necesita el parametro 'ingredients'");
                }
            }
            if (isset($request['size'])) {
                // Verifica que estén correctos los datos
                $this->checkSize($request['size'], $request['product']);
            }

            $order->quantity = $request['quantity'];
            $order->sale_id = $request['sale']['id'];
            $order->product_id = $request['product']['id'];

            // Es opcional
            if (isset($request['size'])) {
                $order->size_id = $request['size']['id'];
            }

            $order->save();

            // Es opcional
            if (isset($request['ingredients'])) {
                foreach ($request['ingredients'] as $ingredient) {
                    $order->ingredients()->attach($ingredient['id']);
                }
            }


            $response->json($order->with(['product', 'size', 'ingredients'])->find($order->id)->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }

    private function checkIngredients($ingredients, $product)
    {
        $maxIngredients = Product::find($product['id'])->maxIngredients;
        $minIngredients = Product::find($product['id'])->minIngredients;

        // Verifica que el producto tenga la cantidad de ingredientes que permite
        if (count($ingredients) > $maxIngredients) {
            throw new \Exception("Este producto no puede tener más de $maxIngredients ingrediente/s.");
        }
        if (count($ingredients) < $minIngredients) {
            throw new \Exception("Este producto no puede tener menos de $minIngredients ingrediente/s.");
        }


        // Verifica que los ingredientes pertenezcan al producto
        foreach ($ingredients as $ingredient) {
            if (!Product::find($product['id'])->ingredients->contains($ingredient['id'])) {
                throw new \Exception("El ingrediente no pertenece al producto indicado.");
            }
        }
    }

    private function checkSize($size, $product)
    {
        // Verifica que el tamaño pertenezca al producto
        if (!Product::find($product['id'])->sizes->contains($size['id'])) {
            throw new \Exception("El tamaño no pertenece al producto indicado.");
        }
    }
}
