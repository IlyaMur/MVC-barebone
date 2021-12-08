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

    public function add(string $route, array $params = []): void
    {
        // convert route to regexp
        $route = preg_replace('/\//', '\\/', $route);

        // convert variables
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                var_dump($matches);
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;

                return true;
            }
        }
        return false;
    }
}
