<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\App\Controllers;

use Ilyamur\PhpMvc\Core\View;
use Ilyamur\PhpMvc\App\Models\Post;

class Posts extends \Ilyamur\PhpMvc\Core\Controller
{
    public function indexAction(): void
    {
        $posts = Post::getAll();

        View::renderTemplate(
            template: 'Posts/index',
            args: ['posts' => $posts]
        );
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
