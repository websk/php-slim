<?php

namespace WebSK\Slim\RequestHandlers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebSK\Slim\Router;

/**
 * Class BaseHandler
 * @package WebSK\Slim\RequestHandlers
 */
abstract class BaseHandler
{
    protected ContainerInterface $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name
     * @param array $data
     * @param array $queryParams
     * @return string
     */
    public function urlFor(string $name, array $data = [], array $queryParams = []): string
    {
        return Router::urlFor($name, $data, $queryParams);
    }

    /**
     * Alternative $_SERVER['REQUEST_URI']
     * @param ServerRequestInterface $request
     * @return string
     */
    public function getRequestUri(ServerRequestInterface $request): string
    {
        $uri = $request->getUri();
        $url_path = $uri->getPath();
        $url_path_explode = explode('/', $url_path);

        return $uri->withPath(implode('/', $url_path_explode));
    }
}
