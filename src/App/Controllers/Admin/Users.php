<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

class Users extends \App\Core\Controller
{
    public function before(): void
    {
        echo 'from before';
    }

    public function after(): void
    {
        echo 'from after';
    }

    public function indexAction(): void
    {
        echo 'hi from index';
    }
}
