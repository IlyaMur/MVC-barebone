<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Models;

use PDO;

class Post extends BaseModel
{
    public static function getAll()
    {
        $db = static::getDB();

        $stmt = $db->query('SELECT id, title, content FROM posts
                            ORDER BY created_at');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}
