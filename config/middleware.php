<?php declare(strict_types=1);

use SavePointOrg\SPBB\Core\Config;
use Slim\Middleware\BodyParsingMiddleware;
use Slim\Middleware\ErrorMiddleware;
use Slim\Middleware\RoutingMiddleware;

return function (Config $config) {
    $config->set('middleware', [
        BodyParsingMiddleware::class,
        RoutingMiddleware::class,
        ErrorMiddleware::class,
    ]);
};
