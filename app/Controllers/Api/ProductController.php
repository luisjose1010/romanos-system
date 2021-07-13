<?php

namespace App\Controllers\Api;

use Framework\Controller;
use App\Models\ProductModel;


class ProductController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get(array $parameters)
    {
        $data = [[
            'id'=>0,
            'name'=>'Pizza',
            'sizes'=>['Pequeño', 'Mediano', 'Grande'],
            'ingredients'=> ['Mango', 'Piña', 'Queso'],
            'multipleIngredients'=>true
        ],[
            'id'=>1,
            'name'=>'Refresco',
            'sizes'=> ['1.5L', '2L'],
            'ingredients'=> ['Coca-Cola', 'Pepsi'],
            'multipleIngredients'=>false
        ]
        ];

        if (!isset($parameters['id'])) {
            echo json_encode($data);
        }
    }
}
