<?php

use Framework\Routing\Routes;

// LLama al controlador principal con cualquier ruta que no use el servidor
Routes::get('/[{query:.+}]', 'HomeController@index');
