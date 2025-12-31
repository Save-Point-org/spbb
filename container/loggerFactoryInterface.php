<?php declare(strict_types=1);

use SavePointOrg\SPBB\Core\Config;
use SavePointOrg\SPBB\Core\LoggerFactory;

return function (Config $config) {
    return new LoggerFactory($config);
};
