<?php

namespace App\Service;
use Psr\Log\LoggerInterface;
class Logger
{
    private LoggerInterface $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log(string $string)
    {
        $this->logger->log('ALERT', $string);
    }
}