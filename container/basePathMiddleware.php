<?php declare(strict_types=1);

use Selective\BasePath\BasePathMiddleware;
use Slim\App;

return function (App $app) {
    return new BasePathMiddleware($app);
};
