<?php

declare(strict_types=1);

/**
 * Application configuration
 *
 * PHP version 8.0
 */

// DB credentials
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'mvc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Show or hide error messages on screen
define('SHOW_ERRORS', true);

// Logs directory
define('LOG_DIR', __DIR__ . '/../logs/' . date('Y-m-d') . '.txt');

// Errors handlers settings
error_reporting(E_ALL);
set_error_handler('Ilyamur\PhpOnRails\Service\ErrorHandler::errorHandler');
set_exception_handler('Ilyamur\PhpOnRails\Service\ErrorHandler::exceptionHandler');
