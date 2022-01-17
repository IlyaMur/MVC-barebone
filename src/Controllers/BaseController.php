<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Controllers;

abstract class BaseController
{
    protected array $routeParams = [];

    public function __call(string $methodName, array $args): void
    {
        $methodName = $methodName . 'Action';

        if (!method_exists($this, $methodName)) {
            throw new \Exception("Method $methodName not found in controller" . get_class($this));
        }

        if ($this->before() !== false) {
            call_user_func_array([$this, $methodName], $args);
            $this->after();
        }
    }

    public function __construct(array $routeParams)
    {
        $this->routeParams = $routeParams;
    }
}
