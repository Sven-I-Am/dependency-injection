<?php
namespace App\Controller;

use App\Service\Logger;
use App\Service\Transform;

class Master
{
    private Transform $toDash;
    private Transform $toCaps;
    private Logger $logger;
    private string $string;

    public function __construct(Transform $toCaps, Transform $toDash, Logger $logger, string $string)
    {
        $this->toCaps = $toCaps;
        $this->toDash = $toDash;
        $this->logger = $logger;
        $this->string = $string;
    }

    public function toCaps(){
        return $this->toCaps->transform($this->string);
    }

    public function toDash(){
        return $this->toDash->transform($this->string);
    }

    public function log(){
        $this->logger->log($this->string);
    }
}