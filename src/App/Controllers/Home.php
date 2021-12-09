<?php

declare(strict_types=1);

namespace App\Controllers;

class Home extends \App\Core\Controller
{
    public function index(): void
    {
        echo 'Hi from Home index';
    }
}
