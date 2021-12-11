<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\App\Models;

use PDO;

class Post extends \Ilyamur\PhpMvc\Core\Model
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
