<?php

namespace WebSK\Slim;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use WebSK\Utils\HTTP;

class Redirect
{
    /**
     * @param ResponseInterface $response
     * @param string|UriInterface $uri
     * @param int $status_code
     * @return ResponseInterface
     */
    public static function redirect(ResponseInterface $response, $uri, int $status_code = HTTP::STATUS_FOUND): ResponseInterface
    {
        if ($uri instanceof UriInterface) {
            $url = $uri->getPath();
            if ($uri->getQuery()) {
                $url .= '?' . $uri->getQuery();
            }

            return $response
                ->withHeader('Location', $url)
                ->withStatus($status_code);
        }

        return $response
            ->withHeader('Location', $uri)
            ->withStatus($status_code);
    }
}