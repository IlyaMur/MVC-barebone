<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Tests\Unit\Views;

use PHPUnit\Framework\TestCase;
use Ilyamur\PhpOnRails\Views\BaseView;

class BaseViewTest extends TestCase
{
    /**
     * @dataProvider templatesProvider
     */

    public function testCorrectlyRendersTemplate(string $templateName): void
    {
        $testTemplate = file_get_contents(dirname(__DIR__) . "/__fixtures__/$templateName.txt");
        BaseView::renderTemplate($templateName);

        $this->expectOutputString($testTemplate);
    }

    public function templatesProvider()
    {
        return [
            ['404'],
            ['500']
        ];
    }
}
