<?php

namespace WebSK\Slim;

use Slim\App;
use LogicException;

/**
 * Class Facade
 * @package WebSK\Slim
 */
class Facade
{
    /** @var App<*> Slim application instance. */
    public static App $app;

    /** @param App<*> $app */
    public static function setFacadeApplication(App $app): void
    {
        Facade::$app = $app;
    }

    /** @param array<int, mixed> $args */
    public static function __callStatic(string $method, array $args): mixed
    {
        return static::self()->$method(...$args);
    }

    /**
     * Set the service name to static proxy.
     * You can override this function to set a facade for the service name you
     * returned.
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return '';
    }

    /**
     * Set the instance which needs facades.
     * You can override this function to set a facade for the instance you
     * returned.
     * @return mixed
     */
    public static function self(): mixed
    {
        $container = Facade::$app->getContainer();

        if ($container === null) {
            throw new LogicException('The Slim application does not have a container.');
        }

        return $container->get(static::getFacadeAccessor());
    }
}
