<?php

declare(strict_types=1);

namespace WebSK\Slim\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Interfaces\RouteParserInterface;
use WebSK\Slim\Facade;
use WebSK\Slim\RequestHandlers\BaseHandler;
use WebSK\Slim\Router;
use WebSK\Slim\Tests\Support\ArrayContainer;

final class RouterAndBaseHandlerTest extends TestCase
{
    public function testBuildsNamedRouteAndDelegatesFromBaseHandler(): void
    {
        $container = new ArrayContainer();
        $app = AppFactory::create(new ResponseFactory(), $container);
        $app->get('/users/{id}', function (
            ServerRequestInterface $request,
            ResponseInterface $response
        ): ResponseInterface {
            return $response;
        })->setName('user');
        $container->set(RouteParserInterface::class, $app->getRouteCollector()->getRouteParser());
        Facade::setFacadeApplication($app);

        $handler = new class($container) extends BaseHandler {
        };

        self::assertSame('/users/42?tab=profile', Router::urlFor('user', ['id' => '42'], ['tab' => 'profile']));
        self::assertSame('/users/42?tab=profile', $handler->urlFor('user', ['id' => '42'], ['tab' => 'profile']));
    }

    public function testReturnsRequestUriWithQueryString(): void
    {
        $container = new ArrayContainer();
        $handler = new class($container) extends BaseHandler {
        };
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/path/to?page=2');

        self::assertSame('/path/to?page=2', $handler->getRequestUri($request));
    }
}
