<?php

use Framework\Routing\Route;
use Framework\Routing\Routes;

Routes::api(new Route('/producto', 'Api\ProductController@get', 'GET'));
