<?php

use Framework\Routing\Routes;

Routes::get('/', 'HomeController@index');

Routes::get('/productos', 'ProductsController@index');
Routes::get('/productos/{id}', 'ProductsController@get');

Routes::get('/vender', 'SellController@index');
Routes::get('/vender/agregar', 'SellController@add');
