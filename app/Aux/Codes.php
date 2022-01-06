<?php

namespace App\Aux;

abstract class Codes
{
    /**
     * remove todos os espaços por um traço
     *
     * @param string|null $string
     * @return void
     */
    public static function removeAllSpaces(string $string = null)
    {
        if (empty($string))
        {
            return 'vaga-de-trabalho-'.time();
        }

        $result = str_replace(' ', '-', $string);

        return $result;
    }

    /**
     * remove todos os traços por um espaço em branco
     *
     * @param string|null $string
     * @return void
     */
    public static function removeAllTracos(string $string = null)
    {
        if (empty($string))
        {
            return 'vaga-de-trabalho-'.time();
        }

        $result = str_replace('-', ' ', $string);

        return $result;
    }

    /**
     * remove traços e deixa nenhum espaço
     *
     * @param string|null $string
     * @return void
     */
    public static function removeTracos(string $string = null)
    {
        if (empty($string))
        {
            return 'vaga-de-trabalho-'.time();
        }

        $result = str_replace('-', '', $string);

        return $result;
    }

    /**
     * separa uma string em um array
     * o segundo parametro é pelo o que quer separar
     * @param string $content
     * @param string $s
     * @return array
     */
    public static function separateInArray(string $content = null, $s)
    {
        if (empty($content))
        {
            return null;
        }

        $result = [];

        $content = self::removeAllSpaces($content);
        $result = explode($s,$content);

        return $result;
    }
}