<?php

use Slim\Middleware\BodyParsingMiddleware;

return function () {
    return new BodyParsingMiddleware();
};
