<?php
namespace App\Cron;

use App\Aux\Codes;
use App\Models\Vagas;

abstract class WebScrapper
{
	const Estados = array(
		'0'=>'acre',
		'1'=>'alagoas',
		'2'=>'amapá',
		'3'=>'amazonas',
		'4'=>'bahia',
		'5'=>'ceará',
		'6'=>'distrito-federal',
		'7'=>'espírito-santo',
		'8'=>'goiás',
		'9'=>'maranhão',
		'10'=>'mato-grosso',
		'11'=>'mato-grosso-do-sul',
		'12'=>'minas-gerais',
		'13'=>'pará',
		'14'=>'paraíba',
		'15'=>'paraná',
		'16'=>'pernambuco',
		'17'=>'piauí',
		'18'=>'rio-de-janeiro',
		'19'=>'rio-grande-do-norte',
		'20'=>'rio-grande-do-sul',
		'21'=>'rondônia',
		'22'=>'roraima',
		'23'=>'santa-catarina',
		'24'=>'são-paulo',
		'25'=>'sergipe',
		'26'=>'tocantins'
	);
	const EstadosSigla = array(
		'0'=>'AC',
		'1'=>'AL',
		'2'=>'AP',
		'3'=>'AM',
		'4'=>'BA',
		'5'=>'CE',
		'6'=>'DF',
		'7'=>'ES',
		'8'=>'GO',
		'9'=>'MA',
		'10'=>'MT',
		'11'=>'MS',
		'12'=>'MG',
		'13'=>'PA',
		'14'=>'PB',
		'15'=>'PR',
		'16'=>'PE',
		'17'=>'PI',
		'18'=>'RJ',
		'19'=>'RN',
		'20'=>'RS',
		'21'=>'RO',
		'22'=>'RR',
		'23'=>'SC',
		'24'=>'SP',
		'25'=>'SE',
		'26'=>'TO'
	);
	
	/**
	 * metodo que fará um scrapper no site - trabalhabrasil
	 *
	 * @return array
	 */
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

	/**
	 * metodo que fará um scrapper no site - Jooble
	 *
	 * @return array
	 */
	public static function getNewVagas2()
	{
		$datavagas = [];

		// var auxliares
		$estadosBrasileiros = self::Estados;
		$auxestados = count($estadosBrasileiros);
		libxml_use_internal_errors(true);

		for( $controlefor=0; $controlefor < $auxestados; $controlefor++)
		{
			$html = file_get_contents('https://br.jooble.org/SearchResult?rgns='.$estadosBrasileiros[$controlefor]);
			$domDocument = new \DOMDocument();
			$domDocument->LoadHTML($html);
			$titulotags = $domDocument->getElementsByTagName("span");
			$tituloList = '';

			foreach($titulotags as $titulo)
			{
				if(strpos($titulo->getAttribute('class'), '_1b9db') === 0)
				{
					$tituloList .= $titulo->textContent . "<br>";
					$tituloArray = explode("<br>", $tituloList);
				}
			}

			$descricaoTags = $domDocument->getElementsByTagName("div");
			$descricaoList = '';

			foreach($descricaoTags as $descricao)
			{
				if(strpos($descricao->getAttribute('class'), '_10840') === 0)
				{
					$descricaoList .= $descricao->textContent . "<br>";
					$descricaoArray = explode("<br>", $descricaoList);
				}
			}

			$localTags = $domDocument->getElementsByTagName("div");
			$localList = '';

			foreach($localTags as $local)
			{
				if(strpos($local->getAttribute('class'), 'caption d7cb2') === 0)
				{
					$localList .= $local->textContent . "<br>";
					$localArray = explode("<br>", $localList);
				}
			}

			$linkTags = $domDocument->getElementsByTagName("a");
			$linkList = '';

			foreach($linkTags as $link)
			{
				if(strpos($link->getAttribute('class'), '_3c619 _37900 _3c815') === 0)
				{
					$linkList .= $link->getAttribute('href') . "<br>";
					$linkArray = explode("<br>", $linkList);
				}
			}

			$arrayVagas = count($tituloArray);
			$controlewhile = 0;

			while($controlewhile < $arrayVagas-1)
			{
				$tituloVaga = $tituloArray[$controlewhile];
				$localVaga = $localArray[$controlewhile];
				$descricaoVaga = $descricaoArray[$controlewhile];
				$linkVaga = $linkArray[$controlewhile];
				$cidadeVaga = null;
				$estadoVaga = null;
				$localVaga = Codes::separateInArray($localVaga, ",");

				if (isset($localVaga[0]))
				{
					$cidadeVaga = Codes::removeAllTracos($localVaga[0]);
				}
				if (isset($localVaga[1]))
				{
					$estadoVaga = Codes::removeTracos($localVaga[1]);
				}

				$datavagas[] = [
					"titulo" => $tituloVaga,
					"empresa" => null,
					"remuneracao" => -1,
					"n_vagas" => -1,
					"cidade" => $cidadeVaga,
					"estado" => $estadoVaga,
					"desc_vaga" => $descricaoVaga,
					"link" => $linkVaga,
					"slug" => null
				];

				$controlewhile = $controlewhile + 1;
			}
		}

		return $datavagas;
	}

	/**
	 * metodo que fará um scrapper no site - Vagas
	 *
	 * @return array
	 */
	public static function getNewVagas3()
	{
		$datavagas = [];
		// var aux
		$estadosBrasileiros = self::EstadosSigla;
		$auxestados = count($estadosBrasileiros);
		libxml_use_internal_errors(true);

		for( $controlefor=0; $controlefor < $auxestados; $controlefor++)
		{
			$html = file_get_contents('https://www.vagas.com.br/vagas-de-'.$estadosBrasileiros[$controlefor]);
			$domDocument = new \DOMDocument();
			$domDocument->LoadHTML($html);
			$titulotags = $domDocument->getElementsByTagName("h2");
			$tituloList = '';

			foreach($titulotags as $titulo)
			{
				if(strpos($titulo->getAttribute('class'), 'cargo') == 0)
				{
					$tituloList .= $titulo->textContent . "<br>";
					$tituloArray = explode("<br>", $tituloList);
				}
			}

			$empresaTags = $domDocument->getElementsByTagName("span");
			$empresaList = '';

			foreach($empresaTags as $empresa)
			{
				if(strpos($empresa->getAttribute('class'), 'emprVaga') === 0)
				{
					$empresaList .= $empresa->textContent . "<br>";
					$empresaArray = explode("<br>", $empresaList);
				}
			}

			$localTags = $domDocument->getElementsByTagName("span");
			$localList = '';

			foreach($localTags as $local)
			{
				if(strpos($local->getAttribute('class'), 'vaga-local') === 0)
				{
					$localList .= $local->textContent . "<br>";
					$localArray = explode("<br>", $localList);
				}
			}

			$descricaoTags = $domDocument->getElementsByTagName("p");
			$descricaoList = '';

			foreach($descricaoTags as $descricao)
			{
				if(strpos($descricao->getAttribute('style'), 'overflow: hidden') == 0)
				{
					$descricaoList .= $descricao->textContent . "<br>";
					$descricaoArray = explode("<br>", $descricaoList);
				}
			}

			$linkTags = $domDocument->getElementsByTagName("a");
			$linkList = '';

			foreach($linkTags as $link)
			{
				if(strpos($link->getAttribute('class'), 'link-detalhes-vaga') === 0)
				{
					$linkList .= $link->getAttribute('href') . "<br>";
					$linkArray = explode("<br>", $linkList);
				}
			}

			$arrayVagas = count($tituloArray);
			$controlewhile = 0;

			while($controlewhile < $arrayVagas-1)
			{
				$tituloVaga = str_replace('\n', '', $tituloArray[$controlewhile]);
				$tituloVaga = str_replace('\r', '', $tituloVaga);
				$tituloVaga = str_replace('  ', '', $tituloVaga);

				$empresaVaga = str_replace('\n', '', $empresaArray[$controlewhile]);
				$empresaVaga = str_replace('\r', '', $empresaVaga);
				$empresaVaga = str_replace('   ', '', $empresaVaga);

				$localVaga = str_replace('\n', '', $localArray[$controlewhile]);
				$localVaga = str_replace('\r', '', $localVaga);
				$localVaga = str_replace('  ', '', $localVaga);

				$descricaoVaga = str_replace('\n', '', $descricaoArray[$controlewhile]);
				$descricaoVaga = str_replace('\r', '', $descricaoVaga);

				$linkVaga = "https://www.vagas.com.br" .$linkArray[$controlewhile];

				$datavagas[] = [
					"titulo" => $tituloVaga,
					"empresa" => $empresaVaga,
					"remuneracao" => -1,
					"n_vagas" => -1,
					"cidade" => $localVaga,
					"estado" => null,
					"desc_vaga" => $descricaoVaga,
					"link" => $linkVaga,
					"slug" => null
				];

				$controlewhile = $controlewhile + 1; 
			}
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