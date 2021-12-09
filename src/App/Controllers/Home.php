<?php

declare(strict_types=1);

namespace App\Controllers;

use \App\Core\View;

class Home extends \App\Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate('Home/index.php', [
            'name' => 'Ilya',
            'colors' => ['red', 'green']
        ]);
    }

    public function before()
    {
    }

    public function after()
    {
    }
}
