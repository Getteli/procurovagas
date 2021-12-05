<?php
namespace App\Cron;

use App\Models\Vagas;

abstract class WebScrapper
{
	public static function getNewVagas()
	{
		$datavagas = [];
		libxml_use_internal_errors(true);
		$html = file_get_contents('https://www.trabalhabrasil.com.br/vagas-empregos');
		$domDocument = new \DOMDocument();
		$domDocument->LoadHTML($html);
		$titulotags = $domDocument->getElementsByTagName("h3");
		$tituloList = '';
		foreach($titulotags as $titulo)
		{
			if(strpos($titulo->getAttribute('class'), 'job__name') === 0)
			{
				$tituloList .= $titulo->textContent . "<br>";
				$tituloArray = explode("<br>", $tituloList);
			}
		}
		$empresaTags = $domDocument->getElementsByTagName("h4");
		$empresaList = '';
		foreach($empresaTags as $empresa)
		{
			if(strpos($empresa->getAttribute('class'), 'job__company') === 0)
			{    
				$empresaList .= $empresa->textContent . "<br>";
				$empresaArray = explode("<br>", $empresaList);
			}
		}
		$localTags = $domDocument->getElementsByTagName("h5");
		$localList = '';
		foreach($localTags as $local)
		{
			if(strpos($local->getAttribute('class'), 'job__detail') === 0)
			{        
				$localList .= $local->textContent . "<br>";
				$localArray = explode("<br>", $localList);
			}
		}
		$descricaoTags = $domDocument->getElementsByTagName("p");
		$descricaoList = '';
		foreach($descricaoTags as $descricao)
		{
			if(strpos($descricao->getAttribute('class'), 'job__description') === 0)
			{    
				$descricaoList .= $descricao->textContent . "<br>";
				$descricaoArray = explode("<br>", $descricaoList);
			}
		}
		$linkTags = $domDocument->getElementsByTagName("a");
		$linkList = '';
		foreach($linkTags as $link)
		{
			if(strpos($link->getAttribute('class'), 'job__vacancy') === 0)
			{    
				$linkList .= $link->getAttribute('href') . "<br>";
				$linkArray = explode("<br>", $linkList);
			}
		}
		$arrayVagas = count($tituloArray);
		$x = 0;
		$y = 0;
		while($x < $arrayVagas-1)
		{
			$salarioVaga = null;
			$tituloVaga = $tituloArray[$x];
			$empresaVaga = $empresaArray[$x];
			// Necessario para atribuir o salario certo a vaga a qual diz respeito e separar o local do estado.
			if(strncmp($localArray[$y], "R$", 2) === 0)
			{
				$salarioVaga = $localArray[$y];
				$auxiliarLocal = explode("/", $localArray[$y+1]);
				$cidadeVaga = $auxiliarLocal[0];
				$estadoVaga = $auxiliarLocal[1];
				$y = $y+2;
			}
			else
			{  
				$auxiliarLocal = explode("/", $localArray[$y]);
				$cidadeVaga = $auxiliarLocal[0];
				$estadoVaga = $auxiliarLocal[1];
				$y = $y+1;
			}
			$descricaoVaga = $descricaoArray[$x];
			$slug = $linkArray[$x];
			$slug = substr($slug,1);
			$slug = str_replace('/', '_', $slug);
			$linkVaga = "https://www.trabalhabrasil.com.br" .$linkArray[$x];
			$x = $x + 1;
			$nvagas = 1;

			// pega o n de vagas no titulo
			$word1 = "vagas";
			$tituloVaga = strtolower($tituloVaga);
			if( (strpos($tituloVaga, $word1) !== false))
			{
				$nvagas = substr($tituloVaga, 0, 2);
				$nvagas = str_replace(' ', '', $nvagas);
				if (!is_numeric($nvagas))
				{
					$nvagas = 1;
				}
				$tituloVaga = substr($tituloVaga,2);
				$tituloVaga = str_replace('vagas de', '', $tituloVaga);
			}
			else
			{
				$tituloVaga = str_replace('vaga de', '', $tituloVaga);
			}

			// ajusta o salario para o banco
			$salarioVaga = substr($salarioVaga, 2);
			$salarioVaga = str_replace(' ', '', $salarioVaga);
			$salarioVaga = str_replace('.', '', $salarioVaga);
			$salarioVaga = str_replace(',', '.', $salarioVaga);

			$salarioVaga = ( empty($salarioVaga) || $salarioVaga == "" || $salarioVaga == null ? 0.00 : $salarioVaga );

			$datavagas[] = [
				"titulo" => $tituloVaga,
				"empresa" => $empresaVaga,
				"remuneracao" => $salarioVaga,
				"n_vagas" => $nvagas,
				"cidade" => $cidadeVaga,
				"estado" => $estadoVaga,
				"desc_vaga" => $descricaoVaga,
				"link" => $linkVaga,
				"slug" => $slug
			];
		}

		return $datavagas;
	}

	public static function verifyData()
	{
		$vagas = new Vagas();
		$vagas = $vagas->whereNotNull('tempo_vaga')->get();
		
		foreach ($vagas as $key => $value)
		{
			$tempovaga = $value->tempo_vaga;
			$datahoje = date( 'Y-m-d H:i:s', strtotime( 'now' ) );;

			// se nao tiver data, passa direto
			if (!$tempovaga)
			{
				return;
			}

			// se a data da vaga ja passou, deleta
			if ($datahoje >= $tempovaga)
			{
				$value->delete();
			}
		}
	}
}