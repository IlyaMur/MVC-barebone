<?php

declare(strict_types=1);

class Router
{
    protected array $routes = [];
    protected array $params = [];

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function add(string $route, array $params): void
    {
        $this->routes[$route] = $params;
    }

    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if ($url === $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
}
