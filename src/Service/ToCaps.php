<?php

namespace App\Service;

class ToCaps implements Transform
{
    public function transform(string $string): string
    {
        $input = str_split($string);
        $output = [];
        for($i=0; $i<count($input); $i++){
            if($i%2===0){
                array_push($output, strtoupper($input[$i]));
            } else {
                array_push($output, $input[$i]);
            }

        }
        return implode("", $output);
    }
}