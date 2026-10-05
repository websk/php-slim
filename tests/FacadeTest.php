<?php

declare(strict_types=1);

namespace WebSK\Slim\Tests;

use LogicException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use WebSK\Slim\Container;
use WebSK\Slim\Facade;
use WebSK\Slim\Request;
use WebSK\Slim\Tests\Support\ArrayContainer;

final class FacadeTest extends TestCase
{
    public function testFacadeDelegatesToContainerEntry(): void
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/facade');
        $container = new ArrayContainer([ServerRequestInterface::class => $request]);
        $app = AppFactory::create(new ResponseFactory(), $container);
        Facade::setFacadeApplication($app);

        self::assertSame($container, Container::self());
        self::assertSame('/facade', Request::getUri()->getPath());
    }

    public function testContainerFacadeRejectsApplicationWithoutContainer(): void
    {
        Facade::setFacadeApplication(AppFactory::create(new ResponseFactory()));

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('does not have a container');

        Container::self();
    }
}
