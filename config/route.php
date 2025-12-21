<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SavePointOrg\SPBB\Core\Config;

return function (Config $config) {
    // this is just some placeholder stuff

    $config->set('route.routes', [
        [
            'methods' => ['GET'],
            'pattern' => '/',
            'callback' => function (ServerRequestInterface $request, ResponseInterface $response) {
                $response->getBody()->write('Hello World!');
                return $response;
            },
            'name' => 'home'
        ]
    ]);

    $config->set('route.groups', []);
};
