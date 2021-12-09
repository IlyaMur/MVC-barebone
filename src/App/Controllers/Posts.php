<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\App\Controllers;

use \Ilyamur\PhpMvc\Core\View;

class Posts extends \Ilyamur\PhpMvc\Core\Controller
{
    public function indexAction(): void
    {
        View::renderTemplate('Posts/index');
    }

    public function addNewAction(): void
    {
        echo 'Hi from addNew action!';
    }

    public function editAction(): void
    {
        echo htmlspecialchars(print_r($this->route_params, true));
    }

    public function before(): void
    {
    }

    public function after(): void
    {
    }
}
