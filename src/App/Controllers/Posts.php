<?php

declare(strict_types=1);

namespace App\Controllers;

class Posts extends \Core\Controller
{
    public function indexAction(): void
    {
        echo 'Hi from index action!';
        echo '<pre>';
        echo htmlspecialchars(print_r($_GET, true));
        echo '</pre>';
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
        echo 'from before';
    }

    public function after(): void
    {
        echo 'from after';
    }
}
