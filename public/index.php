<?php

declare(strict_types=1);

/**
 * Front Controller
 * 
 * PHP version 8.0
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    $root = dirname(__DIR__) . '/src';
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';

    if (is_readable($file)) {
        require $file;
    }
});

/**
 * Routing
 */

$router = new Core\Router();

$router->add(route: '', params: ['controller' => 'Home', 'action' => 'index']);
$router->add(route: '{controller}/{action}');
$router->add(route: 'ru/{controller}/{action}');
$router->add(route: '{controller}/{id:\d+}/{action}');
$router->add(route: 'admin/{controller}/{action}', params: ['namespace' => 'Admin']);

$router->dispatch($_SERVER['QUERY_STRING']);
