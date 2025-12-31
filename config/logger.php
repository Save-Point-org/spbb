<?php declare(strict_types=1);

use Psr\Log\LogLevel;
use SavePointOrg\SPBB\Core\Config;

return function (Config $config) {
    $config->set(key: 'path.logs', value: $config->get(key: 'path.working') . '/logs');
    $config->set(key: 'logger.level', value: LogLevel::DEBUG);
};
