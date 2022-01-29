<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Controllers;

use Ilyamur\PhpOnRails\Models\User;
use Ilyamur\PhpOnRails\Views\BaseView;
use Ilyamur\PhpOnRails\Controllers\BaseController;

/**
 * Home controller
 * Description: Demo Controller for testing the framerwork
 *
 * PHP version 8.0
 */
class Home extends BaseController
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction(): void
    {
        $users = User::getAll();
        BaseView::renderTemplate('Home/index', [
            'users' => $users
        ]);
    }
}
