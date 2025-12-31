<?php declare(strict_types=1);

use Slim\App;
use Slim\Middleware\RoutingMiddleware;

return function (App $app) {
    return new RoutingMiddleware(
        routeResolver: $app->getRouteResolver(),
        routeParser: $app->getRouteCollector()->getRouteParser(),
    );
};
