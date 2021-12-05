<?php
namespace App\Enum;

abstract class Origem
{
	const WebScrapper = 1; // diz que a origem da vaga veio pelo webscrapper
	const Cadastro = 2; // diz que a origem da vaga veio por cadastro no site

	#region METHOD IS

		/**
		 * metodo que verifica pelo tipo se é webscrapper
		 * metodo estatico
		 * @param int $type
		 * @return boolean
		 */
		public static function isWebScrapper(int $type)
		{
			if ($type == self::WebScrapper)
			{
				return true;
			}

			return false;
		}
	#endregion
}