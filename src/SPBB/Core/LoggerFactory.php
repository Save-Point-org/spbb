<?php

namespace SavePointOrg\SPBB\Core;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LoggerFactory implements LoggerFactoryInterface
{
    private array $handler = [];

    public function __construct(
        private Config $config,
    )
    {
        $this->config->loadConfig(name: 'logger');
    }

    public function createLogger(?string $name = null): LoggerInterface
    {
        $logger = new Logger(name: $name ?? 'error');

        foreach ($this->handler as $handler) {
            $logger->pushHandler($handler);
        }

        return $logger;
    }

    public function addFile(string $filename): LoggerFactoryInterface
    {
        $path = $this->config->get(key: 'path.logs', default: '');
        $filename = $path . '/' . $filename;

        $rotatingFileHandler = new RotatingFileHandler(
            filename: $filename,
            maxFiles: 0,
            level: $this->config->get(key: 'logger.level', default: LogLevel::DEBUG),
            bubble: true,
            filePermission: 0755
        );
        $rotatingFileHandler->setFormatter(new LineFormatter(
            ignoreEmptyContextAndExtra: true
        ));

        $this->handler[] = $rotatingFileHandler;

        return $this;
    }
}
