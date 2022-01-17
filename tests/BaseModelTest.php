<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests;

use Mockery;
use Ilyamur\PhpOnRails\Tests\TestDoubles\BaseModelChild;

class BaseModelTest extends \Mockery\Adapter\Phpunit\MockeryTestCase
{
    public function testReturnsPDOObject()
    {
        $this->assertInstanceOf('PDO', BaseModelChild::getDB());
    }
}
