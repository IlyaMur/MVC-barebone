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
            args: ['posts' => $posts],
        );
    }

    public function addNewAction(): void
    {
        $_SESSION['alert'][] = 'added';
        header('location: /');
    }

    public function editAction(): void
    {
    }

    public function before(): void
    {
    }

    public function after(): void
    {
    }
}
