<?php

use Framework\Routing\Routes;
use Framework\Configuration\RoutesConfiguration;

require RoutesConfiguration::getPath();
require RoutesConfiguration::getApiPath();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {
    $routeCollector->addGroup('/api', function (FastRoute\RouteCollector $routeCollector) {
        foreach (Routes::getApi() as $apiRoute) {
            $routeCollector->addRoute($apiRoute->getMethod(), $apiRoute->getRoutePattern(), $apiRoute->getClousure());
        }
    });
    foreach (Routes::getRoutes() as $route) {
        $routeCollector->addRoute($route->getMethod(), $route->getRoutePattern(), $route->getClousure());
    };
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

$routes = new Routes($routeInfo);
$routes->initiateRouting();
