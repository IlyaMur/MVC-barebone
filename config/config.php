<?php

/**
 * Configuration file
 */

declare(strict_types=1);

// db credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// showing additional errors info
const SHOW_ERRORS = false;

// logs directory
define('LOG_DIR', __DIR__ . '/../logs/' . date('Y-m-d') . '.txt');

// errors handlers settings
error_reporting(E_ALL);
set_error_handler('Ilyamur\PhpOnRails\Error::errorHandler');
set_exception_handler('Ilyamur\PhpOnRails\Error::exceptionHandler');
