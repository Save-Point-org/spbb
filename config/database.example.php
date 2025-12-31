<?php declare(strict_types=1);

// Copy this file as database.php, and change the values to match your database
// configuration.

return function (Config $config) {
    $config->set('database', [
        'host' => 'localhost',  // Where your database is hosted ( usually localhost )
        'port' => 3306,         // Port your database listens on ( usually 3306 )
        'dbname' => '',         // Name of database
        'user' => '',           // Database username
        'password' => '',       // Password for your database user
    ]);
};
