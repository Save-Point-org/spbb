<?php declare(strict_types=1);

use Odan\Session\Middleware\SessionStartMiddleware;
use SavePointOrg\SPBB\Core\Config;
use SavePointOrg\SPBB\Core\ErrorHandlerMiddleware;
use SavePointOrg\SPBB\Core\HttpExceptionMiddleware;
use Selective\BasePath\BasePathMiddleware;
use Slim\Middleware\BodyParsingMiddleware;
use Slim\Middleware\ErrorMiddleware;
use Slim\Middleware\RoutingMiddleware;

return function (Config $config) {
    $config->set('middleware', [
        BodyParsingMiddleware::class,
        SessionStartMiddleware::class,
        RoutingMiddleware::class,
        BasePathMiddleware::class,
        HttpExceptionMiddleware::class,
        ErrorHandlerMiddleware::class,
        ErrorMiddleware::class,
    ]);
};
