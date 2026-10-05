<?php

namespace WebSK\Slim;

use Psr\Container\ContainerInterface;
use LogicException;

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
        $container = self::$app->getContainer();

        if ($container === null) {
            throw new LogicException('The Slim application does not have a container.');
        }

        return $container;
    }
}
