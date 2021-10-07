<?php

use Framework\Routing\Route;
use Framework\Routing\Routes;

Routes::api(new Route('/producto', 'Api\ProductController@get', 'GET'));
Routes::api(new Route('/producto', 'Api\ProductController@post', 'POST'));
