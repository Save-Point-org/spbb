<?php declare(strict_types=1);

use Odan\Session\PhpSession;
use SavePointOrg\SPBB\Core\Config;

return function (Config $config) {
    $config->loadConfig(name: 'session');
    return new PhpSession($config->get(key: 'session', default: []));
};
