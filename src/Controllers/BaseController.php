<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Controllers;

/**
 * Base controller
 *
 * PHP version 8.0
 */
abstract class BaseController
{
    /**
     * Parameters from the matched route
     * @var array
     */
    protected array $routeParams = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct(array $routeParams)
    {
        $this->routeParams = $routeParams;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods.
     *
     * @param string $name  Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     */
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

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }
}
