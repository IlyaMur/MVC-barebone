<?php

declare(strict_types=1);

use Dotenv\Dotenv;

/**
 * Application configuration
 *
 * PHP version 8.0
 */

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// DB credentials
define('DB_USER', $_ENV['MYSQL_USER']);
define('DB_PASSWORD',  $_ENV['MYSQL_PASSWORD']);
define('DB_HOST', $_ENV['MYSQL_HOST']);
define('DB_NAME',  $_ENV['MYSQL_DATABASE']);

// Show or hide error messages on screen
define('SHOW_ERRORS', true);

// Logs directory
define('LOG_DIR', __DIR__ . '/../logs/' . date('Y-m-d') . '.txt');

// Errors handlers settings
error_reporting(E_ALL);
set_error_handler('Ilyamur\PhpOnRails\Service\ErrorHandler::errorHandler');
set_exception_handler('Ilyamur\PhpOnRails\Service\ErrorHandler::exceptionHandler');
