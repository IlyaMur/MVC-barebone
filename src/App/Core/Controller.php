<?php

namespace App\Core;

abstract class Controller
{
    protected array $route_params = [];

    public function __construct(array $route_params)
    {
        $this->route_params = $route_params;
    }
}
