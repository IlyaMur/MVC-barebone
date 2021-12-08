<?php

declare(strict_types=1);

/**
 * Front Controller
 * 
 * PHP version 8.0
 */

require '../src/Core/Router.php';
require '../src/App/Controllers/Posts.php';

/**
 * Routing
 */

$router = new Router();

$router->add(route: '', params: ['controller' => 'Home', 'action' => 'index']);

$router->add(route: '{controller}/{action}');
$router->add(route: '{controller}/{id:\d+}/{action}');


$router->dispatch($_SERVER['QUERY_STRING']);
