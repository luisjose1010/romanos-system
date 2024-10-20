<?php

use Framework\Routing\Route;
use Framework\Routing\Routes;

// Autenticación
Routes::api(new Route('/token', 'Api\AuthController@index', 'GET'));
Routes::api(new Route('/token', 'Api\AuthController@refreshToken', 'PUT'));

// Usuarios
Routes::api(new Route('/users', 'Api\UserController@get', 'GET'));
Routes::api(new Route('/users/all', 'Api\UserController@getAll', 'GET'));
Routes::api(new Route('/users/{id:\d+}', 'Api\UserController@get', 'GET'));
Routes::api(new Route('/users/{id:\d+}/all', 'Api\UserController@getAll', 'GET'));

Routes::api(new Route('/users/all', 'Api\UserController@postAll', 'POST'));

Routes::api(new Route('/users/{id:\d+}', 'Api\UserController@put', 'PUT'));

// Roles
Routes::api(new Route('/roles', 'Api\RoleController@get', 'GET'));
Routes::api(new Route('/roles/{id:\d+}', 'Api\RoleController@get', 'GET'));

// Contraseña, reestablecer y relacionado
Routes::api(new Route('/password', 'Api\PasswordController@post', 'POST'));

// Copia de seguridad
Routes::api(new Route('/backup', 'Api\BackupController@post', 'POST'));

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
Routes::api(new Route('/clients/all', 'Api\ClientController@getAll', 'GET'));
Routes::api(new Route('/clients/{id:\d+}', 'Api\ClientController@get', 'GET'));
Routes::api(new Route('/clients/{id:\d+}/all', 'Api\ClientController@getAll', 'GET'));

Routes::api(new Route('/clients', 'Api\ClientController@post', 'POST'));

Routes::api(new Route('/clients/{id:\d+}', 'Api\ClientController@put', 'PUT'));
