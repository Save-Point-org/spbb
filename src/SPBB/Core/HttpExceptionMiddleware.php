<?php

namespace SavePointOrg\SPBB\Core;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpException;

class HttpExceptionMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory
    )
    {
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (HttpException $exception) {
            $code = $exception->getCode();
            $response = $this->responseFactory->createResponse($code);

            // TODO: Output a template instead of string
            $response->getBody()->write(sprintf('<h1>Error: %s</h1>', $exception->getMessage()));

            return $response;
        }
    }
}
