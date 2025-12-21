<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Middleware\RoutingMiddleware;

return function (ContainerInterface $container) {
    $app = $container->get(id: App::class);

    return new RoutingMiddleware(
        routeResolver: $app->getRouteResolver(),
        routeParser: $app->getRouteCollector()->getRouteParser(),
    );
};
