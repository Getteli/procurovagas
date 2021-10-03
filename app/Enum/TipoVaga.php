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
}