<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\Controllers;

use \Ilyamur\PhpMvc\Views\BaseView;

class Home extends \Ilyamur\PhpMvc\Controllers\BaseController
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
