<?php

namespace SavePointOrg\SPBB\Core;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

class Route
{
    /**
     * @param App $app
     * @param Config $config
     */
    public function __construct(
        private App $app,
        private Config $config,
    )
    {
        $this->config->loadConfig(name: 'route');
        $this->register();
    }

    /**
     * @return void
     */
    private function register() : void
    {
        $this->basicRoutes();
        $this->groupRoutes();
    }

    private function createRoute(
        App|RouteCollectorProxy $handler,
        array $route
    ) : void {
        $methods = $route['methods'];
        $pattern = $route['pattern'];
        $callback = $route['callback'];
        $name = $route['name'] ?? false;
        $middlewares = $route['middlewares'] ?? [];

        $map = $handler->map(methods: $methods, pattern: $pattern, callable: $callback);

        foreach ($middlewares as $middleware) {
            $map->add($middleware);
        }

        if ($name !== false) {
            $map->setName($name);
        }
    }

    private function basicRoutes() : void
    {
        $routes = $this->config->get(key: 'route.routes', default: []);

        foreach ($routes as $route) {
            $this->createRoute(handler: $this->app, route: $route);
        }
    }

    private function groupRoutes() : void
    {
        $groups = $this->config->get(key: 'route.groups', default: []);

        foreach ($groups as $group) {
            $pattern = $group['pattern'];
            $routes = $group['routes'];
            $middlewares = $group['middlewares'];

            $map = $this->app->group(pattern: $pattern, callable: function (RouteCollectorProxy $proxy) use ($routes) {
                foreach ($routes as $route) {
                    $this->createRoute(handler: $proxy, route: $route);
                }
            });

            foreach ($middlewares as $middleware) {
                $map->add($middleware);
            }
        }
    }
}
