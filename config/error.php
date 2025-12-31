<?php declare(strict_types=1);

use SavePointOrg\SPBB\Core\Config;

return function (Config $config) {
    $config->set('error.displayErrorDetails', $config->get(key: 'app.environment', default: 'prod') === 'dev');
    $config->set('error.logErrors', true);
    $config->set('error.logErrorDetails', true);
};
