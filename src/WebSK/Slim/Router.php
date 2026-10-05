<?php

namespace WebSK\Slim;

use Slim\Interfaces\RouteInterface;
use Slim\Interfaces\RouteParserInterface;

/**
 * Class RouterFacade
 * @package WebSK\Slim
 * @method static RouteInterface map(list<string> $methods, string $pattern, callable $handler)
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
     * @param array<string, string> $data
     * @param array<string, string|array<array-key, string>> $queryParams
     * @return string
     * @throws \Throwable
     */
    public static function urlFor(string $routeName, array $data = [], array $queryParams = []): string
    {
        return static::self()->urlFor($routeName, $data, $queryParams);
    }
}
