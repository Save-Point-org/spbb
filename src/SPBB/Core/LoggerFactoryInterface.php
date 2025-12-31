<?php

namespace SavePointOrg\SPBB\Core;

use Psr\Log\LoggerInterface;

interface LoggerFactoryInterface
{
    public function createLogger(string $name = null): LoggerInterface;

    public function addFile(string $filename): LoggerFactoryInterface;
}
