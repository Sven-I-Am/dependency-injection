<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Logger
{
    public function log(LoggerInterface $logger, string $string)
    {
        $logger->log('info', $string);
    }
}