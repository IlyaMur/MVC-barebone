<?php

namespace Ilyamur\PhpMvc\Core;

use PDO;
use Ilyamur\PhpMvc\config\Config;

abstract class Model
{
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $host = Config::DB_HOST;
            $dbname = Config::DB_NAME;
            $username = Config::DB_USER;
            $password = Config::DB_PASSWORD;

            try {
                $db = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8",
                    $username,
                    $password
                );
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }
}
