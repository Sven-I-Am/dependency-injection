<?php

namespace App\Service;

class ToDash implements Transform
{
    function transform(string $string): string
    {
        return str_replace(" ", "-", $string);
    }
}