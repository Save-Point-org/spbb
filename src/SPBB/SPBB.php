<?php declare(strict_types=1);

namespace SavePointOrg\SPBB;

use SavePointOrg\SPBB\Core\Config;

/**
 * If for whatever reason somebody tries to run this script directly,
 * set the header to 403 forbidden, and terminate processing.
 */
if (! defined(constant_name: 'IN_SPBB') || IN_SPBB !== true) {
    header(header: 'HTTP/1.1 403 Forbidden');
    $error_message = "Direct script access forbidden.";
    exit($error_message);
}

class SPBB
{
    /**
     * Class Constructor
     *
     * Runs initialization
     *
     * @access public
     * @return void
     */
    public function __construct(
        string $working_dir = '',
        string $public_dir = '',
    )
    {
        $config = new Config(
            working_dir: $working_dir,
            public_dir: $public_dir,
        );
    }
}
