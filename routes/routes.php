<?php

use Framework\Routing\Routes;

Routes::get('/', 'HomeController@index');

Routes::get('/vender', 'SellController@index');
Routes::get('/vender/agregar', 'SellController@add');
