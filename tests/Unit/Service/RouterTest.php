<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests\Service;

use Ilyamur\PhpOnRails\Service\Router;
use Ilyamur\PhpOnRails\Tests\Unit\Service\TestDoubles\RouterChild;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function setUp(): void
    {
        $this->router = new Router();
    }

    public function testCorrectlyDispatchToTheController()
    {
        $routerMock = $this->getMockBuilder(Router::class)
            ->onlyMethods(['getNamespace'])
            ->getMock();
        $routerMock->method('getNamespace')
            ->willReturn('Ilyamur\PhpOnRails\Tests\Unit\Controllers\TestDoubles\\');

        $routerMock->add(
            'basecontrollerchild/testmethod',
            ['controller' => 'BaseControllerChild', 'action' => 'testMethod']
        );

        $routerMock->dispatch('basecontrollerchild/testmethod');

        $this->expectOutputString('testMethod called');
    }

    /**
     * @dataProvider routesProvider
     */

    public function testRoutesAddCorrectly(string $route, array $params, array $parsedRoute): void
    {
        $this->router->add($route, $params);
        $this->assertEquals($parsedRoute, $this->router->getRoutes());
    }

    public function testCorrectlyReturnNamespaceWhenExists()
    {
        $this->router->add(route: 'admin/{controller}/{action}', params: ['namespace' => 'Admin']);
        $this->router->match('admin/foo/bar');

        $namespaceWithAdmin = $this->router->getNamespace();
        $this->assertEquals('Ilyamur\\PhpOnRails\\Controllers\\Admin\\', $namespaceWithAdmin);
    }

    public function testCorrectlyReturnNamespaceWhenNoneExists()
    {
        $this->router->add(route: 'admin/{controller}/{action}');
        $this->router->match('admin/foo/bar');

        $namespaceWithAdmin = $this->router->getNamespace();
        $this->assertEquals('Ilyamur\\PhpOnRails\\Controllers\\', $namespaceWithAdmin);
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

    public function testMatchOnUrl(string $route, string $string, bool $isMatch, array $params = [])
    {
        $this->router->add($route, $params);

        $this->assertSame($isMatch, $this->router->match($string));
    }

    public function testThrowAnExceptionWhenDoesNotHaveMatchesInDispatch()
    {
        $this->router->add('admin/{controller}/{action}');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No route matched');

        $this->router->dispatch('foo/bar');
    }

    public function testThrowAnExceptionWhenClassNotFoundInDispatch()
    {
        $this->router->add('{controller}/{action}');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Controller class Ilyamur\PhpOnRails\Controllers\Bazbar not found");

        $this->router->dispatch('bazbar/foo');
    }

    public function testThrowAnExceptionWhenQueryStringHasActionCall()
    {
        // when URL has mysite.com/controller/someAction
        // instead of mysite.com/controller/some

        $this->router->add('{controller}/{action}');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(
            "indexAction in controller Ilyamur\PhpOnRails\Controllers\Home can't be called - remove the Action suffix"
        );

        $this->router->dispatch('home/indexAction');
    }

    public function testRoutesAreEmptyInDefaultState(): void
    {
        $this->assertEmpty($this->router->getRoutes());
    }

    public function testParamsAreEmptyInDefaultState(): void
    {
        $this->assertEmpty($this->router->getParams());
    }

    public function testCorrectlyRemoveQueryStringVars()
    {
        $routerChild = new RouterChild();

        $url1 = $routerChild->removeQueryStringVariables('posts/index&page=1');
        $url2 = $routerChild->removeQueryStringVariables('page=1');

        $this->assertEquals('posts/index', $url1);
        $this->assertEmpty($url2);
    }

    public function routesProvider()
    {
        return [
            'Correctly parse with empty params' => [
                '{controller}/{action}', [], ['/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i' => []]
            ],
            'Correctly parse with empty route' => [
                '', ['controller' => 'Home', 'action' => 'index'], ['/^$/i' =>
                ['controller' => 'Home', 'action' => 'index']]
            ],
            'Correctly parse with :id' => [
                '{controller}/{id:\d+}/{action}', [],
                ['/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i' => []]
            ],
            'Correctly parse with namespace' => [
                'admin/{controller}/{action}', ['namespace' => 'Admin'],
                ['/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i' => ['namespace' => 'Admin']]
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
