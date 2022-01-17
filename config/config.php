<?php

declare(strict_types=1);

// db credentials

define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// showing additional errors info
const SHOW_ERRORS = true;

// errors settings
error_reporting(E_ALL);

set_error_handler('Ilyamur\PhpOnRails\Error::errorHandler');
set_exception_handler('Ilyamur\PhpOnRails\Error::exceptionHandler');
