<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use SavePointOrg\SPBB\Core\Config;
use SavePointOrg\SPBB\Core\Middleware;
use SavePointOrg\SPBB\Core\Route;
use Slim\Factory\AppFactory;

return function (ContainerInterface $container) {
    $app = AppFactory::createFromContainer($container);
    $config = $container->get(Config::class);

    new Route(app: $app, config: $config);
    new Middleware(app: $app, config: $config);

    return $app;
};
