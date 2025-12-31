<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use SavePointOrg\SPBB\Core\Config;
use SavePointOrg\SPBB\Core\LoggerFactoryInterface;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (ContainerInterface $container) {
    $app = $container->get(App::class);
    $config = $container->get(Config::class);
    $config->loadConfig(name: 'error');

    $logger = $container->get(LoggerFactoryInterface::class)
        ->addFile('error.log')
        ->createLogger();

    return new ErrorMiddleware(
        callableResolver: $app->getCallableResolver(),
        responseFactory: $app->getResponseFactory(),
        displayErrorDetails: $config->get(key: 'error.displayErrorDetails', default: false),
        logErrors: $config->get(key: 'error.logErrors', default: true),
        logErrorDetails: $config->get(key: 'error.logErrorDetails', default: true),
        logger: $logger,
    );
};
