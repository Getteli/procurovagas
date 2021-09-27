<?php
namespace App\Enum;

abstract class Origem
{
	const WebScrapper = 1;
	const Cadastro = 2;
}

abstract class TipoEmail
{
	const Empregado = 1;
	const Empresa = 2;
}

abstract class Subscribe
{
	const ReceberTudo = 1;
	const ReceberApenasVagas = 2;
	const ReceberApenasInformativos = 3;
}

abstract class TipoVaga
{
	const Integral = "Integral";
	const MeioPeriodo = "Meio período";
	const Estagio = "Estágio";
	const JovemAprendiz = "Jovem Aprendiz";
	const Trainee = "Trainee";
}

abstract class FormaTrabalho
{
	const Presencial = "Presencial";
	const HomeOffice = "HomeOffice";
	const Hibrido = "Hibrído";
}
