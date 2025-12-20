<?php declare(strict_types=1);

namespace SavePointOrg\SPBB;

use DI\ContainerBuilder;
use Exception;
use SavePointOrg\SPBB\Core\Config;
use Slim\App;

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
    private App $app;

    /**
     * Class Constructor
     *
     * Runs initialization
     *
     * @access public
     * @return void
     * @throws Exception
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

        switch ($config->get(key: 'app.environment', default: 'prod')) {
            case 'dev':
                error_reporting(error_level: E_ALL);
                ini_set(option: 'display_errors', value: '1');
                break;
            default:
                error_reporting(error_level: 0);
                ini_set(option: 'display_errors', value: '0');
        }

        $config->loadConfig(name: 'container');
        $container = (new ContainerBuilder())
            ->addDefinitions($config->get(key: 'container', default: []))
            ->build();

        $this->app = $container->get(App::class);
    }

    public function run(): void
    {
        $this->app->run();
    }
}
