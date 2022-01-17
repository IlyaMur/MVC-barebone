<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests\Unit\Controllers\TestDoubles;

use Ilyamur\PhpOnRails\Controllers\BaseController;

class BaseControllerChild extends BaseController
{
    public function testMethodAction()
    {
        echo 'testMethod called';
    }

    public function before()
    {
    }

    public function after()
    {
    }
}
