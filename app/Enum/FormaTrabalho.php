<?php
namespace App\Enum;

abstract class FormaTrabalho
{
	const Presencial = "Presencial";
	const HomeOffice = "HomeOffice";
	const Hibrido = "Hibrído";

	#region METHODS

		public static function list(){
			$array = array(
				"Presencial" => self::Presencial,
				"HomeOffice" => self::HomeOffice,
				"Hibrído" => self::Hibrido,
			);
			return $array;
		}
	#endregion
}
