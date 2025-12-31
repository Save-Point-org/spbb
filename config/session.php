<?php declare(strict_types=1);

use SavePointOrg\SPBB\Core\Config;

return function (Config $config) {
    // uses standard PHP session configuration values
    // see: https://www.php.net/manual/en/session.configuration.php

    $config->set(key: 'session', value: [
        'name' => 'spbb',
    ]);
};
