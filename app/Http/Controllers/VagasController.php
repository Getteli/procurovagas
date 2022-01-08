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
		try
		{
			// var aux
			$vagas = new Vagas();

			// site 1
			$vagasWS1 = WebScrapper::getNewVagas();
			$result1 = $vagas->createVagaWS($vagasWS1);

			// site 2
			$vagasWS2 = WebScrapper::getNewVagas3();
			$result2 = $vagas->createVagaWS($vagasWS2);

			// site 3
			$vagasWS3 = WebScrapper::getNewVagas3();
			$result3 = $vagas->createVagaWS($vagasWS3);

			if ($result1 !== true || $result2 !== true || $result3 !== true)
			{
				throw new \Exception($result1 . " | " . $result2 . " | " . $result3);
			}
		}
		catch (\Throwable $th)
		{
			Mail::to(\Config::get('mail.from.address'))
			->send(new SendFormAbout($th->getMessage(),
			"metodo: getNewVagas()", "erro ao pegar novas vagas", "", 'now'));
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
				Mail::to(\Config::get('mail.from.address'))
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

	public function testeEmail()
	{
		Mail::to(\Config::get('mail.from.address'))
		->send(new SendFormAbout("teste titulo",
		"hello world", "testeeee", "", 'now'));
	}
}
