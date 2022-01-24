<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 8.0
 */
class User extends BaseModel
{
    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
