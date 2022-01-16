<?php

declare(strict_types=1);

namespace Ilyamur\PhpMvc\Controllers;

use Ilyamur\PhpMvc\Views\BaseView;
use Ilyamur\PhpMvc\Models\Post;

class Posts extends \Ilyamur\PhpMvc\Controllers\BaseController
{
    public function indexAction(): void
    {
        $posts = Post::getAll();

        BaseView::renderTemplate(
            template: 'Posts/index',
            args: ['posts' => $posts],
        );
    }

    public function addNewAction(): void
    {
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
