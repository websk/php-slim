<?php

namespace WebSK\Slim;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\RouteGroupInterface;
use Slim\Interfaces\RouteInterface;

/**
 * Class RouterFacade
 * @package WebSK\Slim
 * @method static RouteInterface map(array $methods, string $pattern, callable $handler)
 * @method static array dispatch(ServerRequestInterface $request)
 * @method static RouteGroupInterface pushGroup(string $pattern, callable $callable)
 * @method static bool popGroup()
 * @method static RouteInterface getNamedRoute(string $name)
 * @method static RouteInterface lookupRoute($identifier)
 * @method static string relativePathFor(string $name, array $data = [], array $queryParams = [])
 * @method static string pathFor(string $name, array $data = [], array $queryParams = [])
 * @see RouteInterface
 */
class Router extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}
