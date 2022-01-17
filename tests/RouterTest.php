<?php

use Ilyamur\PhpOnRails\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function setUp(): void
    {
        $this->router = new Router();
    }

    public function testRoutesAreEmptyInDefaultState(): void
    {
        $this->assertEmpty($this->router->getRoutes());
    }

    public function testParamsAreEmptyInDefaultState(): void
    {
        $this->assertEmpty($this->router->getParams());
    }

    /**
     * @dataProvider routesProvider
     */
    public function testRoutesAddingCorrectly(string $route, array $params, array $parsedRoute): void
    {
        $this->router->add($route, $params);
        $this->assertEquals($parsedRoute, $this->router->getRoutes());
    }

    public function routesProvider()
    {
        return [
            'Correctly parse with empty params' => [
                '{controller}/{action}', [], ['/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i' => []]
            ],
        ];
    }
}
