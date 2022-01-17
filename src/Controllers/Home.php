<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Controllers;

use Ilyamur\PhpOnRails\Views\BaseView;

class Home extends BaseController
{
    public function indexAction()
    {
        BaseView::renderTemplate('Home/index', [
            'name' => 'John Doe',
            'colors' => ['red', 'green', 'blue'],
        ]);
    }

    public function before()
    {
    }

    public function after()
    {
    }
}
