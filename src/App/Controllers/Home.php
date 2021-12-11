<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\App\Controllers;

use \Ilyamur\PhpMvc\Core\View;

class Home extends \Ilyamur\PhpMvc\Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate('Home/index', [
            'name' => 'Ilya',
            'colors' => ['red', 'green'],
        ]);
    }

    public function before()
    {
    }

    public function after()
    {
    }
}
