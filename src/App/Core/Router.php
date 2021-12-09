<?php

declare(strict_types=1);

namespace App\Core;

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

        // convert variables: {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regexp {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
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

    public function dispatch(string $url): void
    {
        $url = $this->removeQueryStringVariables($url);

        if (!$this->match($url)) {
            exit('No route matched');
        }

        $controller = $this->params['controller'];
        $controller = $this->convertToStudlyCaps($controller);
        $controller = "App\Controllers\\$controller";

        if (!class_exists($controller)) {
            exit("Controller class $controller not found");
        }

        $controller_object = new $controller($this->params);

        $action = $this->params['action'];
        $action = $this->convertToCamelCase($action);

        if (!is_callable([$controller_object, $action])) {
            exit("Method $action (in controller $controller) not found");
        }

        $controller_object->$action();
    }

    protected function convertToCamelCase(string $string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function convertToStudlyCaps(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function removeQueryStringVariables(string $url): string
    {
        if ($url === '') {
            return $url;
        }

        $parts = explode('&', $url, 2);
        $url = str_contains($parts[0], '=') ? '' : $parts[0];

        return $url;
    }
}
