<?php

namespace App\Aux;

abstract class Codes
{
    public static function removeAllSpaces(string $string = null)
    {
        if (empty($string)) {
            return 'vaga-de-trabalho';
        }

        $result = str_replace(' ', '-', $string);

        return $result;
    }
}