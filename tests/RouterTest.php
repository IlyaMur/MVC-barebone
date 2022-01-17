<?php

namespace Ilyamur\PhpOnRails\Tests;

use Ilyamur\PhpOnRails\{Router, Tests\TestDoubles\RouterChild};
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
    public function testRoutesAddCorrectly(string $route, array $params, array $parsedRoute): void
    {
        $this->router->add($route, $params);
        $this->assertEquals($parsedRoute, $this->router->getRoutes());
    }

    public function testCorrectlyRemoveQueryStringVars()
    {
        $routerChild = new RouterChild();

        $url = $routerChild->removeQueryStringVariables('http://test.test/home/index/bar?foo=123&foobar=456');

        $this->assertEmpty($url);
    }

    public function testCorrectlyConvertToCamelcase()
    {
        $routerChild = new RouterChild();

        $string1 = $routerChild->convertToCamelCase('foo-bar-test');
        $string2 = $routerChild->convertToCamelCase('FooBar-test');

        $this->assertEquals('fooBarTest', $string1);
        $this->assertEquals('fooBarTest', $string2);
    }

    public function testCorrectlyConvertToStudlyCaps()
    {
        $routerChild = new RouterChild();

        $string1 = $routerChild->convertToStudlyCaps('foo-bartest');
        $string2 = $routerChild->convertToStudlyCaps('FooBar-test-baz');

        $this->assertEquals('FooBartest', $string1);
        $this->assertEquals('FooBarTestBaz', $string2);
    }

    /**
     * @dataProvider matchesProvider
     */
    public function testMatchOnUrl(string $route, string $url, bool $isMatch, array $params = [])
    {
        $this->router->add($route, $params);

        $this->assertSame($isMatch, $this->router->match($url));
    }

    public function routesProvider()
    {
        return [
            'Correctly parse with empty params' => [
                '{controller}/{action}', [], ['/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i' => []]
            ],
            'Correctly parse with empty route' => [
                '', ['controller' => 'Home', 'action' => 'index'], ['/^$/i' => ['controller' => 'Home', 'action' => 'index']]
            ],
            'Correctly parse with :id' => [
                '{controller}/{id:\d+}/{action}', [], ['/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i' => []]
            ],
            'Correctly parse with namespace' => [
                'admin/{controller}/{action}', ['namespace' => 'Admin'], ['/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i' => ['namespace' => 'Admin']]
            ]
        ];
    }

    public function matchesProvider()
    {
        return [
            ['{controller}/{action}', 'bar/baz', true],
            ['', '', true, ['controller' => 'Home', 'action' => 'index']],
            ['{controller}/{action}', 'bar/baz/foo', false],
            ['{controller}/{action}', 'barbaz', false],
            ['admin/{controller}/{action}', 'admin/bar/baz', true],
            ['{controller}/{id:\d+}/{action}', 'foo/5/baz', true],
            ['{controller}/{id:\d+}/{action}', 'admin/bar/baz', false],
        ];
    }
}
