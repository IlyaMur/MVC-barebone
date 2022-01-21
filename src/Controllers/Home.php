<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Controllers;

use Ilyamur\PhpOnRails\Views\BaseView;

/**
 * Home controller
 * Description: Demo Controller for smoke testing the framerwork 
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
        BaseView::renderTemplate('Home/index', [
            'name' => 'John Doe',
            'colors' => ['red', 'green', 'blue'],
        ]);
    }
}
