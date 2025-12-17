<?php declare(strict_types=1);

use SavePointOrg\SPBB\SPBB;

global $working_dir;
global $public_dir;

// If for whatever reason somebody tries to run this script directly,
// set the header to 403 forbidden, and terminate processing.
if (! defined(constant_name: 'IN_SPBB') || IN_SPBB !== true) {
    header(header: 'HTTP/1.1 403 Forbidden');
    $error_message = "Direct script access forbidden.";
    exit($error_message);
}

// Load composer
require_once $working_dir . '/vendor/autoload.php';

$spbb = new SPBB($working_dir, $public_dir);
