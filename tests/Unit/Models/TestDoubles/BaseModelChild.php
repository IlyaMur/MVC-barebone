<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests\Unit\Models\TestDoubles;

use Ilyamur\PhpOnRails\Models\BaseModel;

class BaseModelChild extends BaseModel
{
    public static function getDB()
    {
        return parent::getDB();
    }
}
