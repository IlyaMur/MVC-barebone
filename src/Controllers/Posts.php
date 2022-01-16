<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Controllers;

use Ilyamur\PhpOnRails\Views\BaseView;
use Ilyamur\PhpOnRails\Models\Post;

class Posts extends \Ilyamur\PhpOnRails\Controllers\BaseController
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
