<?php declare(strict_types=1);

use SavePointOrg\SPBB\SPBB;

CONST IN_SPBB = true;

$public_dir = __DIR__;
$working_dir = dirname(path: __DIR__);

if (file_exists(filename: $autoload = $working_dir . '/vendor/autoload.php'))
    require_once $autoload;
else {
    header(header: 'HTTP/1.1 501 Not Implemented');
    $error_message = "Composer autoloader not found.";
    exit($error_message);
}

(new SPBB($public_dir, $working_dir))->run();
