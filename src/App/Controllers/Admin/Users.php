<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\App\Controllers\Admin;

class Users extends \Ilyamur\PhpMvc\Core\Controller
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
