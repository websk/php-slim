<?php

namespace WebSK\Slim;

use Psr\Container\ContainerExceptionInterface;
use Slim\Interfaces\RouteInterface;
use Slim\Interfaces\RouteParserInterface;

/**
 * Class RouterFacade
 * @package WebSK\Slim
 * @method static RouteInterface map(array $methods, string $pattern, callable $handler)
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
