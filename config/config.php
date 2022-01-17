<?php

declare(strict_types=1);

/**
 * Configuration file
 */

// db credentials
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'mvc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// showing errors info
define('SHOW_ERRORS', true);

// logs directory
define('LOG_DIR', __DIR__ . '/../logs/' . date('Y-m-d') . '.txt');

// errors handlers settings
error_reporting(E_ALL);
set_error_handler('Ilyamur\PhpOnRails\Error::errorHandler');
set_exception_handler('Ilyamur\PhpOnRails\Error::exceptionHandler');
