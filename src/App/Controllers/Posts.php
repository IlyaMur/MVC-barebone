<?php

namespace App\Controllers;

class Posts
{
    public function index(): void
    {
        echo 'Hi from index action!';
    }

    public function addNew(): void
    {
        echo 'Hi from addNew action!';
    }
}
