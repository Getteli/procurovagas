<?php

namespace App\Aux;

abstract class Codes
{
	/**
	 * remove todos os espaços por um traço
	 *
	 * @param string|null $string
	 * @return string
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
	 * @return string
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
	 * @return string
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

	/**
	 * Remover emoji das strings
	 *
	 * @param string $string
	 * @return string
	 */
	public static function removeEmoji(string $string)
	{

		// Match Emoticons
		$regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
		$clear_string = preg_replace($regex_emoticons, '', $string);
	
		// Match Miscellaneous Symbols and Pictographs
		$regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
		$clear_string = preg_replace($regex_symbols, '', $clear_string);
	
		// Match Transport And Map Symbols
		$regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
		$clear_string = preg_replace($regex_transport, '', $clear_string);
	
		// Match Miscellaneous Symbols
		$regex_misc = '/[\x{2600}-\x{26FF}]/u';
		$clear_string = preg_replace($regex_misc, '', $clear_string);
	
		// Match Dingbats
		$regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
		$clear_string = preg_replace($regex_dingbats, '', $clear_string);
	
		// outras merdas q nao sai nem por um caraio inferno
		$regex_saiCapeta = '/[\x{1F957}]/u';
		$clear_string = preg_replace($regex_saiCapeta, '', $clear_string);

		return $clear_string;
	}
}