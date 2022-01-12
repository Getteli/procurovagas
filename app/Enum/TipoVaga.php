<?php
namespace App\Enum;

abstract class TipoVaga
{
	const Integral = "Integral";
	const MeioPeriodo = "Meio período";
	const Estagio = "Estágio";
	const JovemAprendiz = "Jovem Aprendiz";
	const Trainee = "Trainee";

	public static function list()
	{
		$array = array(
			'Integral' => self::Integral,
			'MeioPeriodo' => self::MeioPeriodo,
			'Estagio' => self::Estagio,
			'JovemAprendiz' => self::JovemAprendiz,
			'Trainee' => self::Trainee,
			
		);
		return $array;
	}

	public static function getName(int $type = null)
	{
		$string = "";

		switch ($type)
		{
			case self::Integral:
					return "integral";
				break;
			case self::MeioPeriodo:
					return "meio periodo";
				break;
			case self::Estagio:
					return "estagio";
				break;
			case self::JovemAprendiz:
					return "jovem aprendiz";
				break;
			case self::Trainee:
					return "trainee";
				break;
		}

		return $string;
	}
}