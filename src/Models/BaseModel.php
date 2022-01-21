<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Models;

use PDO;

/**
 * Base model
 *
 * PHP version 8.0
 */
abstract class BaseModel
{
    /**
     * Get the PDO database connection
     *
     * @return PDO
     */
    protected static function getDB(): PDO
    {
        static $db = null;

        if ($db === null) {
            $host = DB_HOST;
            $dbname = DB_NAME;
            $username = DB_USER;
            $password = DB_PASSWORD;

            $db = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $username,
                $password
            );

            // Throw an Exception when an error occur
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}
