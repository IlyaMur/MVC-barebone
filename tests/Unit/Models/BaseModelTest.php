<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use Ilyamur\PhpOnRails\Tests\Unit\Models\TestDoubles\BaseModelChild;

class BaseModelTest extends TestCase
{
    public function testReturnsPDOObject()
    {
        $this->assertInstanceOf('PDO', BaseModelChild::getDB());
    }
}
