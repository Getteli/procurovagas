<?php

namespace App\Http\Controllers;

use App\Enum\TipoVaga;
use Illuminate\Http\Request;
use App\Models\Vagas;
use App\Cron\WebScrapper;
use App\Mail\SendFormCV;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendFormAbout;

class VagasController extends Controller
{

    public function createManually(Request $request)
    {
        try {
            $vaga = new Vagas();
            $result = $vaga->createManually($request);

			if ($result != true) {
				\Session::flash('message',[
					'title'=> 'Vaga criada !',
					'message'=> 'Sua vaga foi criada com sucesso e em instantes começará a rodar para todos os candidatos.',
					'messagetwo' => 'Fique atento logo candidatos entraram em contato.',
					'type' => 'success'
					]);
			}
			else
			{
				// throw new \Exception($result);

				throw new \Exception("erro ao criar a vaga. Tente novamente");
			}
			return redirect()->back()->withInput();
        } catch (\Throwable $e) {
			// create session message
			\Session::flash('message',[
				'title'=> 'Ops :(',
				'message'=> $e->getMessage(),
				'type' => 'danger'
			]);
			return redirect()->back()->withInput();
        }
    }

	public function getVaga($slug)
	{
		try
		{
			$vaga = Vagas::where('slug',$slug)->first();

			if ($vaga)
			{
				return view('content.detail', compact('vaga'));
			}
			return redirect()->back()->withInput();
		}
		catch (\Throwable $th)
		{
			return redirect()->back()->withInput();
		}
	}

	public function searchVaga(Request $request)
	{
		try {
			$vagas = Vagas::getVagaWithParams($request);
			$tipoVaga = TipoVaga::class;

			return view('content.welcome', compact('vagas','tipoVaga'));
		} catch (\Throwable $th) {
			return redirect()->back()->withInput();;
		}
	}

	public function getNewVagas()
	{
		ini_set('max_execution_time', 6000); // 100 min

		// webscrapper 1
		try
		{
			// var aux
			$vagas = new Vagas();

			// site 1
			$vagasWS1 = WebScrapper::getNewVagas();

			// site 2
			// $vagasWS2 = WebScrapper::getNewVagas2();

			// // site 3
			// $vagasWS3 = WebScrapper::getNewVagas3();

			$all_vagas = $vagasWS1;
			// array_merge($vagasWS1, $vagasWS2, $vagasWS3);
			$all_vagas = array_filter($all_vagas);

			$result = $vagas->createVagaWS($all_vagas);

			if ($result !== true)
			{
				throw new \Exception($result);
			}
			else
			{
				$all_vagas = null;
			}
		}
		catch (\Throwable $th)
		{
			dd($th->getMessage());
			// Mail::to(\Config::get('mail.from.address'))
			// ->send(new SendFormAbout($th->getMessage(),
			// "metodo: getNewVagas()", "erro ao pegar novas vagas - getNewVagas()", "", 'now'));
		}

		dd("done");
		exit;
	}

	public function generateSitemap()
	{
		try
		{
			(new Vagas())->sitemapVagas();
		}
		catch (\Throwable $th)
		{
			Mail::to(\Config::get('mail.from.address'))
			->send(new SendFormAbout($th->getMessage(),
			"metodo: generateSitemap()", "erro ao gerar sitemap - generateSitemap()", "", 'now'));
		}
	}

	public function verifyData()
	{
		WebScrapper::verifyData();
	}

	public function sendForm(Request $request)
	{
        try
        {
			foreach ($request->files as $key => $file)
			{
				Mail::to($request->emailowner)
				->send(new SendFormCV('Você recebeu um Currículo na sua vaga de emprego - ProcuroVagas',
				$request->name, $request->description, $request->email, $file,'now'));
			}
    
            \Session::flash('message',[
                'title'=> 'Email enviado com sucesso',
                'message'=> 'O empregador receberá seu email com seu Currículo, boa sorte.',
                'type' => 'success'
            ]);

			return redirect()->back();
        }
        catch (\Throwable $e)
        {
			//"Seu email nao pode ser enviado, tente novamente mais tarde.",
			// create session message
			\Session::flash('message',[
				'title'=> 'Ops :(',
				'message'=> $e->getMessage(),
				'type' => 'danger'
			]);
    
			return redirect()->back()->withInput();
        }
	}
}
