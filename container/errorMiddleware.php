<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use SavePointOrg\SPBB\Core\Config;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (ContainerInterface $container) {
    $app = $container->get(App::class);
    $config = $container->get(Config::class);

    $errorMiddleware = new ErrorMiddleware(
        callableResolver: $app->getCallableResolver(),
        responseFactory: $app->getResponseFactory(),
        displayErrorDetails: $config->get(key: 'app.env', default: 'prod') === 'prod',
        logErrors: true,
        logErrorDetails: true,
    );

    return $errorMiddleware;
};
