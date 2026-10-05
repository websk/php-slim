<?php

declare(strict_types=1);

namespace WebSK\Slim\Tests;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Slim\Psr7\Response as Psr7Response;
use WebSK\Slim\Response;

final class ResponseTest extends TestCase
{
    public function testCreatesJsonResponse(): void
    {
        $response = Response::responseWithJson(
            new Psr7Response(),
            ['ok' => true],
            201,
            JSON_PRETTY_PRINT
        );

        self::assertSame(201, $response->getStatusCode());
        self::assertSame('application/json', $response->getHeaderLine('Content-Type'));
        self::assertSame("{\n    \"ok\": true\n}", (string) $response->getBody());
    }

    public function testThrowsForInvalidJsonValue(): void
    {
        $this->expectException(RuntimeException::class);

        Response::responseWithJson(new Psr7Response(), NAN);
    }
}
