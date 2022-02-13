<?php

namespace WebSK\Slim;

use Psr\Container\ContainerInterface;

/**
 * Class Container
 * @package WebSK\Slim
 */
class Container extends Facade
{
    /**
     * Overriding Facades::self() to set Slim\App instance is in order to tell
     * Facades to proxy it.
     * @return ContainerInterface
     */
    public static function self(): ContainerInterface
    {
        return self::$app->getContainer();
    }
}
