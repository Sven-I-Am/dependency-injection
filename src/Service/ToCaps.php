<?php

namespace App\Service;

class ToCaps implements Transform
{
    public function transform(string $string): string
    {
        $input = str_split($string);
        $output = [];
        for($i=0; $i<count($input); $i+=2){
            array_push($output, strtoupper($input[$i]));
        }
        return implode("", $output);
    }
}