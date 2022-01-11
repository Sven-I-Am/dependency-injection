<?php
namespace App\Controller;

use App\Service\Transform;

class Master
{
    private Transform $toDash;
    private Transform $toCaps;
    private string $string;

    public function __construct(Transform $toCaps, Transform $toDash, string $string)
    {
        $this->toCaps = $toCaps;
        $this->toDash = $toDash;
        $this->string = $string;
    }

    public function toCaps(){
        return $this->toCaps->transform($this->string);
    }

    public function toDash(){
        return $this->toDash->transform($this->string);
    }
}