<?php declare(strict_types=1);

namespace SavePointOrg\SPBB\Core;

use Dflydev\DotAccessData\Data;

/**
 * If for whatever reason somebody tries to run this script directly,
 * set the header to 403 forbidden, and terminate processing.
 */
if (! defined(constant_name: 'IN_SPBB') || IN_SPBB !== true) {
    header(header: 'HTTP/1.1 403 Forbidden');
    $error_message = "Direct script access forbidden.";
    exit($error_message);
}

class Config
{
    /**
     * @var Data Application static configuration data
     */
    private Data $config;

    private array $loaded = [];

    /**
     * Class constructor
     *
     * @param string $working_dir
     * @param string $public_dir
     * @return void
     */
    public function __construct(
        string $working_dir,
        string $public_dir
    )
    {
        $this->config = new Data();

        $this->config->set(key: 'path.working_dir', value: $working_dir);
        $this->config->set(key: 'path.public_dir', value: $public_dir);
        $this->config->set(key: 'path.config_dir', value: $working_dir . '/config');

        if (! defined(constant_name: 'SPBB_ENVIRONMENT'))
            define(constant_name: 'SPBB_ENVIRONMENT', value:  'prod');

        $this->config->set(key: 'app.environment', value: SPBB_ENVIRONMENT);
    }

    /**
     * Load static configuration file
     *
     * @param string $name
     * @return void
     */
    public function loadConfig(
        string $name
    ) : void
    {
        // prevent loading twice
        if (in_array(needle: $name, haystack: $this->loaded, strict: true)) return;

        // load sane defaults
        $default_config = $this->config->get(key: 'path.config_dir') . '/' . $name . '.php';
        if (! file_exists($default_config)) {
            (require_once $default_config)($this);
        }

        // Load environment overrides
        $environment_config = $this->config->get(key: 'path.config_dir') . '/' . $this->config->get(key: 'app.environment') . '/' . $name . '.php';
        if (! file_exists($environment_config)) {
            (require_once $environment_config)($this);
        }
    }

    /**
     * Expose set method
     *
     * @param string $key
     * @param $value
     * @return void
     */
    public function set(string $key, $value) : void
    {
        $this->config->set(key: $key, value: $value);
    }

    /**
     * Expose get method
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null) : mixed
    {
        return $this->config->get(key: $key, default: $default);
    }
}
