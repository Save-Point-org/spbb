<?php declare(strict_types=1);

use Odan\Session\SessionInterface;
use Odan\Session\SessionManagerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use SavePointOrg\SPBB\Core\Config;
use SavePointOrg\SPBB\Core\LoggerFactoryInterface;
use Selective\BasePath\BasePathMiddleware;
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
        PDO::class => require_once $this->config->get('path.container') . '/pdo.php',
        ResponseFactoryInterface::class => require_once $this->config->get('path.container') . '/responseFactoryInterface.php',
        sessionInterface::class => require_once $this->config->get('path.container') . '/sessionInterface.php',
        sessionManagerInterface::class => require_once $this->config->get('path.container') . '/sessionManagerInterface.php',
        LoggerFactoryInterface::class => require_once $this->config->get('path.container') . '/loggerFactoryInterface.php',
    ]);

};
