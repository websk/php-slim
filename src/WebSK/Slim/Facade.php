<?php

namespace WebSK\Slim;

use Slim\App;

/**
 * Class Facade
 * @package WebSK\Slim
 */
class Facade
{
    /**
     * @var App $app slim app instance.
     */
    public static App $app;

    /**
     * @param App $app
     */
    public static function setFacadeApplication(App $app): void
    {
        Facade::$app = $app;
    }

    public static function __callStatic($method, $args)
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
        return Facade::$app->getContainer()[static::getFacadeAccessor()];
    }
}
