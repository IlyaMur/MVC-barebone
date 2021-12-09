<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected array $route_params = [];

    public function __call(string $methodName, array $args): ?string
    {
        $methodName = $methodName . 'Action';

        if (!method_exists($this, $methodName)) {
            return "Method $methodName not found in controller" . get_class($this);
        }

        if ($this->before() !== false) {
            call_user_func_array([$this, $methodName], $args);
            $this->after();
        }

        return null;
    }

    public function __construct(array $route_params)
    {
        $this->route_params = $route_params;
    }
}
