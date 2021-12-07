<?php

declare(strict_types=1);

/**
 * Front Controller
 * 
 * PHP version 8.0
 */

require '../Core/Router.php';

/**
 * Routing
 */

$router = new Router();

$router->add(route: '', params: ['controller' => 'Home', 'action' => 'index']);
$router->add(route: 'posts', params: ['controller' => 'Posts', 'action' => 'index']);
$router->add(route: 'posts/new', params: ['controller' => 'Posts', 'action' => 'new']);

$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    var_dump($router->getParams());
} else {
    echo 'No route found for URL ' . "$url";
}
