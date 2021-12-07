<?php

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

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);

echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';
