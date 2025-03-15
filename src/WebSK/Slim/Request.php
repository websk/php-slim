<?php

namespace WebSK\Slim;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class Request
 * @package WebSK\Slim
 * @method static UriInterface getUri()
 * @method static mixed getAttribute($key, $default = null)
 * @see RequestInterface
 */
class Request extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ServerRequestInterface::class;
    }

    public static function getParsedBodyParam(ServerRequestInterface $request, string $key, $default = null)
    {
        $postParams = $request->getParsedBody();
        $result = $default;

        if (is_array($postParams) && isset($postParams[$key])) {
            $result = $postParams[$key];
        } elseif (is_object($postParams) && property_exists($postParams, $key)) {
            $result = $postParams->$key;
        }

        return $result;
    }
}
