<?php

declare(strict_types=1);

namespace App\Controllers;

class Posts
{
    public function index(): void
    {
        echo 'Hi from index action!';
        echo '<pre>';
        echo htmlspecialchars(print_r($_GET, true));
        echo '</pre>';
    }

    public function addNew(): void
    {
        echo 'Hi from addNew action!';
    }
}
