<?php declare(strict_types=1);

use SavePointOrg\SPBB\Core\Config;
use Slim\App;
use Slim\Middleware\BodyParsingMiddleware;
use Slim\Middleware\ErrorMiddleware;
use Slim\Middleware\RoutingMiddleware;

return function (Config $config) {

    $config->set('container', [
        Config::class => $config,
        App::class => require_once $this->config->get('path.container') . '/app.php',
        ErrorMiddleware::class => require_once $this->config->get('path.container') . '/errorMiddleware.php',
        BodyParsingMiddleware::class => require_once $this->config->get('path.container') . '/bodyParsingMiddleware.php',
        RoutingMiddleware::class => require_once $this->config->get('path.container') . '/routingMiddleware.php',
    ]);

};
