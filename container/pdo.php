<?php declare(strict_types=1);


use SavePointOrg\SPBB\Core\Config;

return function (Config $config) {
    $config->loadConfig(name: 'database');

    $host = $config->get(key: 'database.host', default: 'localhost');
    $port = $config->get(key: 'database.port', default: 3306);
    $dbname = $config->get(key: 'database.dbname');
    $username = $config->get(key: 'database.username');
    $password = $config->get(key: 'database.password');
    $charset = 'utf8mb4';
    $flags = [
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ];

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset;";

    return new PDO($dsn, $username, $password, $flags);
};
