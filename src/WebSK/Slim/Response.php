<?php

namespace WebSK\Slim;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\StreamFactory;

class Response
{
    /**
     * @param $data
     * @param int|null $status
     * @param int $options
     * @param int $depth
     * @return ResponseInterface
     * @throws \Exception
     */
    public static function responseWithJson(
        ResponseInterface $response,
        $data,
        ?int $status = null,
        int $options = 0,
        int $depth = 512
    ): ResponseInterface {
        $stream_factory = new StreamFactory();

        $decorated_response = new \Slim\Http\Response($response, $stream_factory);

        return $decorated_response->withJson($data, $status, $options, $depth);
    }
}