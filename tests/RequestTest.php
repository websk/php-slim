<?php

declare(strict_types=1);

namespace WebSK\Slim\Tests;

use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ServerRequestFactory;
use WebSK\Slim\Request;

final class RequestTest extends TestCase
{
    public function testReadsValueFromArrayBody(): void
    {
        $request = (new ServerRequestFactory())
            ->createServerRequest('POST', '/')
            ->withParsedBody(['name' => 'value']);

        self::assertSame('value', Request::getParsedBodyParam($request, 'name', 'default'));
    }

    public function testReadsValueFromObjectBody(): void
    {
        $request = (new ServerRequestFactory())
            ->createServerRequest('POST', '/')
            ->withParsedBody((object) ['name' => 'value']);

        self::assertSame('value', Request::getParsedBodyParam($request, 'name', 'default'));
    }

    public function testReturnsDefaultForMissingAndNullArrayValues(): void
    {
        $request = (new ServerRequestFactory())
            ->createServerRequest('POST', '/')
            ->withParsedBody(['null' => null]);

        self::assertSame('default', Request::getParsedBodyParam($request, 'missing', 'default'));
        self::assertSame('default', Request::getParsedBodyParam($request, 'null', 'default'));
    }
}
