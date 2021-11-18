<?php

use Framework\Routing\Route;
use Framework\Routing\Routes;

// Productos
Routes::api(new Route('/products', 'Api\ProductController@get', 'GET'));
Routes::api(new Route('/products/all', 'Api\ProductController@getAll', 'GET'));
Routes::api(new Route('/products/ingredients', 'Api\ProductController@getIngredients', 'GET'));
Routes::api(new Route('/products/sizes', 'Api\ProductController@getSizes', 'GET'));

Routes::api(new Route('/products', 'Api\ProductController@post', 'POST'));


// Ordenes
Routes::api(new Route('/orders/all', 'Api\OrderController@getAll', 'GET'));

Routes::api(new Route('/orders/all', 'Api\OrderController@postAll', 'POST'));


// Ventas
Routes::api(new Route('/sales/all', 'Api\SaleController@getAll', 'GET'));
Routes::api(new Route('/sales/{id:\d+}/all', 'Api\SaleController@getAll', 'GET'));

Routes::api(new Route('/sales/all', 'Api\SaleController@postAll', 'POST'));

Routes::api(new Route('/sales/{id:\d+}', 'Api\SaleController@put', 'PUT'));


// Clientes
Routes::api(new Route('/clients', 'Api\ClientController@get', 'GET'));
Routes::api(new Route('/clients/{id:\d+}', 'Api\ClientController@get', 'GET'));

Routes::api(new Route('/clients', 'Api\SaleController@post', 'POST'));

Routes::api(new Route('/clients/{id:\d+}', 'Api\SaleController@put', 'PUT'));
