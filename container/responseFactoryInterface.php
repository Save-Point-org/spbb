<?php declare(strict_types=1);

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
    return $container->get(Psr17Factory::class);
};
