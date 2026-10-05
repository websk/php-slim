<?php

declare(strict_types=1);

namespace WebSK\Slim\Tests;

use PHPUnit\Framework\TestCase;
use Slim\Psr7\Response as Psr7Response;
use Slim\Psr7\Uri;
use WebSK\Slim\Redirect;

final class RedirectTest extends TestCase
{
    public function testRedirectsToStringUriWithDefaultStatus(): void
    {
        $response = Redirect::redirect(new Psr7Response(), '/target');

        self::assertSame(302, $response->getStatusCode());
        self::assertSame('/target', $response->getHeaderLine('Location'));
    }

    public function testRedirectsToUriPathAndQueryWithCustomStatus(): void
    {
        $uri = new Uri('https', 'example.com', 443, '/target', 'page=2', 'fragment');

        $response = Redirect::redirect(new Psr7Response(), $uri, 301);

        self::assertSame(301, $response->getStatusCode());
        self::assertSame('/target?page=2', $response->getHeaderLine('Location'));
    }
}
