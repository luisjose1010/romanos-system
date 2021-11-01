<?php

use Framework\Routing\Route;
use Framework\Routing\Routes;

// Productos
Routes::api(new Route('/product', 'Api\ProductController@get', 'GET'));
Routes::api(new Route('/product/all', 'Api\ProductController@getAll', 'GET'));
Routes::api(new Route('/product/ingredient', 'Api\ProductController@getIngredients', 'GET'));
Routes::api(new Route('/product/size', 'Api\ProductController@getSizes', 'GET'));

Routes::api(new Route('/product', 'Api\ProductController@post', 'POST'));


// Ordenes
Routes::api(new Route('/order/all', 'Api\OrderController@getAll', 'GET'));

Routes::api(new Route('/order/all', 'Api\OrderController@postAll', 'POST'));


// Ventas
Routes::api(new Route('/sale/all', 'Api\SaleController@getAll', 'GET'));

Routes::api(new Route('/sale', 'Api\SaleController@post', 'POST'));

Routes::api(new Route('/sale/{id:\d+}', 'Api\SaleController@put', 'PUT'));
