<?php

namespace WebSK\Slim;

use Psr\Container\ContainerExceptionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\RouteGroupInterface;
use Slim\Interfaces\RouteInterface;
use Slim\Interfaces\RouteParserInterface;

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
    protected static function getFacadeAccessor(): string
    {
        return RouteParserInterface::class;
    }

    /**
     * @param string $routeName
     * @param array $data
     * @param array $queryParams
     * @return string
     * @throws ContainerExceptionInterface
     * @throws \Throwable
     */
    public static function urlFor(string $routeName, array $data = [], array $queryParams = []): string
    {
        try {
            return static::self()->urlFor($routeName, $data, $queryParams);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
