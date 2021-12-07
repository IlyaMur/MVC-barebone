<?php

class Router
{
    protected array $routes = [];

    public function add(string $route, array $params): void
    {
        $this->routes[$route] = $params;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
