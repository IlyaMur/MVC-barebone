<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests\Fixtures;

use Ilyamur\PhpOnRails\Controllers\BaseController;

class TestController extends BaseController
{
    public function testAction()
    {
        echo 'testAction';
    }

    public function before()
    {
    }

    public function after()
    {
    }
}
