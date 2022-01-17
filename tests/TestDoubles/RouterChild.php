<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests\TestDoubles;

use Ilyamur\PhpOnRails\Router;

class RouterChild extends Router
{
    public function convertToCamelCase(string $string): string
    {
        return parent::convertToCamelCase($string);
    }

    public function convertToStudlyCaps(string $string): string
    {
        return parent::convertToStudlyCaps($string);
    }

    public function removeQueryStringVariables(string $url): string
    {
        return parent::removeQueryStringVariables($url);
    }
}
