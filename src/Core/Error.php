<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\Core;

class Error
{
    public static function errorHandler(int $level, string $message, string $file, int $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message,  0,  $level,  $file,  $line);
        }
    }

    public static function exceptionHandler(\Throwable $exception)
    {
        echo "<h1>Fatal error</h1>";
        echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        echo "<p>Message: '" . $exception->getMessage() . "'</p>";
        echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in '" . $exception->getFile() . "' on line " .
            $exception->getLine() . "</p>";
    }
}
