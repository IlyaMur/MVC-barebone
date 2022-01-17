<?php

namespace Ilyamur\PhpOnRails\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use Ilyamur\PhpOnRails\Service\ErrorHandler;

class ErrorHandlerTest extends TestCase
{
    public function testConvertErrorToExceptionIfEnabled(): void
    {
        $this->expectException(\ErrorException::class);

        ErrorHandler::errorHandler(0, 'test', 'testFile', 7);
    }

    public function testDoesNotConvertErrorToExceptionIfDisabled(): void
    {
        error_reporting(0);
        $this->assertNull(ErrorHandler::errorHandler(0, 'test', 'testFile', 7));
    }

    public function testPrintOutExceptionMessageIfShowErrorsIsTrue()
    {
        $testException = file_get_contents(dirname(__DIR__) . "/__fixtures__/exception.txt");

        ob_start();
        ErrorHandler::exceptionHandler(new \Exception('test', 7));
        $exceptionRender = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($testException, $exceptionRender);
    }
}
