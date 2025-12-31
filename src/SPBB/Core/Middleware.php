<?php

namespace SavePointOrg\SPBB\Core;

use Slim\App;

class Middleware
{
    public function __construct(
        App $app,
        Config $config,
    )
    {
        $config->loadConfig(name: 'middleware');
        $middlewares = $config->get(key: 'middleware', default: []);
        foreach ($middlewares as $middleware) $app->add($middleware);
    }
}
