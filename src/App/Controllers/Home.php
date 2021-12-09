<?php

declare(strict_types=1);

namespace App\Controllers;

class Home extends \App\Core\Controller
{
    public function indexAction()
    {
        echo 'Hi from Home index';
    }

    public function before()
    {
        echo 'from before';
        return false;
    }

    public function after()
    {
        echo 'from after';
    }
}
